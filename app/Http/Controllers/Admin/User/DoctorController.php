<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\DoctorRequest;
use App\Models\Department\Department;
use App\Models\User\Doctor;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $doctors = DB::transaction(function () {
            return Doctor::all();
        }, 5);

        return view('admin.user.doctor.index', [
            'doctors' => $doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function create()
    {
        $departments = DB::transaction(function () {
            return Department::all();
        }, 5);

        return view('admin.user.doctor.create', [
            'departments' => $departments
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
    public function store(DoctorRequest $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required|numeric|unique:doctors,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:doctors,home_phone';
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                $user = User::create($request->all());

                $imageUrl = $request->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/doctor', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return Doctor::create($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::doctor::index'))
                ->with('success_message', 'Successfully create new doctor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show(Doctor $doctor)
    {
        return view('admin.user.doctor.show', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, Doctor $doctor)
    {
        $departments = DB::transaction(function () {
            return Department::all();
        }, 5);

        return view('admin.user.doctor.edit', [
            'departments' => $departments,
            'doctor' => $doctor,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(DoctorRequest $request, User $user, Doctor $doctor)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:doctors,mobile_phone,' . $doctor->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:doctors,home_phone,' . $doctor->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $doctor) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $doctor->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/department', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                return $doctor->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::doctor::index'))->with('success_message', 'Successfully updated doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, Doctor $doctor)
    {
        try {
            DB::transaction(function () use ($doctor, $user) {
                $doctor->delete();
                return $user->delete();
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted doctor');
    }
}
