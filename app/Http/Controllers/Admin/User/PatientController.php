<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PatientRequest;
use App\Models\User\Patient;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $patients = DB::transaction(function () {
            return Patient::paginate(20);
        }, 5);

        return view('admin.user.patient.index', [
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function create()
    {
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        return view('admin.user.patient.create', [
            'blood_groups', $bloodGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function store(PatientRequest $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required|numeric|unique:patients,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:patients,home_phone';
        }
        $this->validate($request, $rules);

        DB::transaction(function () use ($request) {
            $request['name'] = "{$request->first_name} {$request->last_name}";
            $user = User::create($request->all());

            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/patients', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            $request['user_id'] = $user->id;
            return Patient::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::patient::index'))->with('success_message', 'Successfully create new patient');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Patient  $patient
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show(Patient $patient)
    {
        return view('admin.user.patient.show', [
            'patient' => $patient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Patient  $patient
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, Patient $patient)
    {
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        return view('admin.user.patient.edit', [
            'user' => $user,
            'patient' => $patient,
            'blood_groups' => $bloodGroups
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Models\User\Patient  $patient
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(PatientRequest $request, User $user, Patient $patient)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:patients,mobile_phone,' . $patient->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:patients,home_phone,' . $patient->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $patient) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $patient->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/patients', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return $patient->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::patient::index'))->with('success_message', 'Successfully updated patient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Patient  $patient
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, Patient $patient)
    {
        try {
            DB::transaction(function () use ($patient, $user) {
                $patient->delete();
                return $user->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted patient');
    }
}
