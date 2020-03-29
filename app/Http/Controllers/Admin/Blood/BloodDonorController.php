<?php

namespace App\Http\Controllers\Admin\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blood\BloodDonorRequest;
use App\Models\Blood\BloodDonor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BloodDonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $donors = DB::transaction(function () {
            return BloodDonor::paginate(20);
        }, 5);

        return view('admin.blood.donor.index', [
            'donors' => $donors
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
        return view('admin.blood.donor.create', [
            'blood_groups' => $bloodGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Blood\BloodDonorRequest  $request
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function store(BloodDonorRequest $request)
    {
        DB::transaction(function () use ($request) {
            $request['age'] = Carbon::parse($request->birth_date)->age;
            return BloodDonor::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::blood::donor::index'))->with('success_message', 'Successfully add new donors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blood\Donor  $donor
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show(BloodDonor $donor)
    {
        return view('admin.blood.donor.show', [
            'donor' => $donor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blood\Donor  $donor
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(BloodDonor $donor)
    {
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        return view('admin.blood.donor.edit', [
            'donor' => $donor,
            'blood_groups' => $bloodGroups
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Blood\BloodDonorRequest  $request
     * @param  \App\Models\Blood\Donor  $donor
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(BloodDonorRequest $request, BloodDonor $donor)
    {
        try {
            DB::transaction(function () use ($request, $donor) {
                $request['age'] = Carbon::parse($request->birth_date)->age;
                return $donor->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::blood::donor::index'))->with('success_message', 'Successfully updated donors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blood\Donor  $donor
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(BloodDonor $donor)
    {
        try {
            DB::transaction(function () use ($donor) {
                return $donor->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::blood::donor::index'))->with('success_message', 'Successfully deleted donors');
    }
}
