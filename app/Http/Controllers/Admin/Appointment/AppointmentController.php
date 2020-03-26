<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Models\Appoitment\Appoitment;
use App\Models\User\{ Doctor, Patient };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = DB::transaction(function () {
            return Appoitment::with('doctor', 'patient')->paginate(20);
        }, 5);

        return view('admin.appointment.index', [
            'appointments' => $appointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = DB::transaction(function () {
            return Patient::select('id', 'first_name', 'last_name')->get();
        }, 5);

        $doctors = DB::transaction(function () {
            return Doctor::select('id', 'first_name', 'last_name')->get();
        }, 5);

        return view('admin.appointment.create', [
            'patients' => $patients,
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $request['appointment_number'] = "#APMT-" . Carbon::now()->format('dmYHis');
            return Appoitment::create($request->all());
        });

        return redirect(route('admin::appointment::index'))->with('success_message', 'Successfully create new appointment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appoitment $appointment)
    {
        return view('admin.appointment.show', [
            'appointment' => $appointment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appoitment $appointment)
    {
        $patients = DB::transaction(function () {
            return Patient::select('id', 'first_name', 'last_name')->get();
        }, 5);

        $doctors = DB::transaction(function () {
            return Doctor::select('id', 'first_name', 'last_name')->get();
        }, 5);

        return view('admin.appointment.edit', [
            'patients' => $patients,
            'doctors' => $doctors,
            'appointment' => $appointment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Appoitment $appointment)
    {
        try {
            DB::transaction(function () use ($request, $appointment) {
                return $appointment->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::appointment::index'))->with('success_message', 'Successfully updated appointment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appoitment $appointment)
    {
        try {
            DB::transaction(function () use ($appointment) {
                return $appointment->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return back()->with('error_message', 'Successfully deleted appointment');
    }
}
