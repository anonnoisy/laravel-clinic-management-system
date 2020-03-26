<?php

namespace App\Http\Controllers\Admin\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bed\BedAllotmentRequest;
use App\Models\Bed\Bed;
use App\Models\Bed\BedAllotment;
use App\Models\User\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BedAllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $bedAllotments = DB::transaction(function () {
            return BedAllotment::paginate(20);
        }, 5);

        return view('admin.bed.allotment.index', [
            'bed_allotments' => $bedAllotments
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
        $beds = DB::transaction(function () {
            return Bed::all();
        }, 5);

        $patients = DB::transaction(function () {
            return Patient::all();
        }, 5);

        return view('admin.bed.allotment.create', [
            'beds' => $beds,
            'patients' => $patients
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
    public function store(BedAllotmentRequest $request)
    {
        try {
            $bed = Bed::find($request->bed_id);
            if ($bed->bed_currently < 1) {
                return back()->with('error_message', "Sorry for bed number: {$bed->bed_number} is full");
            }

            $bedAllotment = BedAllotment::where('patient_id', $request->patient_id)->first();
            if (!empty($bedAllotment)) {
                $dateNow = Carbon::now()->format('Y-m-d 00:00:00');
                if ($bedAllotment->discharge_time >= $dateNow) {
                    return back()->with('error_message', "Sorry for patient: {$bedAllotment->patient->name} is currently used bed number: {$bedAllotment->bed->bed_number}, please check!");
                }
            }

            DB::transaction(function () use ($request, $bed) {
                $bed_currently = $bed->bed_currently - 1;
                $bed_usage = $bed->bed_usage + 1;
                $bed->update([
                    'bed_currently' => $bed_currently,
                    'bed_usage' => $bed_usage
                ]);
                return BedAllotment::create($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::allotment::index'))->with('success_message', 'Successfully create new bed allotment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed\BedAllotment  $bedAllotment
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show($id)
    {
        return view('admin.bed.allotment.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed\BedAllotment  $bedAllotment
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(BedAllotment $allotment)
    {
        $beds = DB::transaction(function () {
            return Bed::all();
        }, 5);

        $patients = DB::transaction(function () {
            return Patient::all();
        }, 5);

        return view('admin.bed.allotment.edit', [
            'beds' => $beds,
            'patients' => $patients,
            'bed_allotment' => $allotment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed\BedAllotment  $bedAllotment
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(BedAllotmentRequest $request, BedAllotment $allotment)
    {
        try {
            DB::transaction(function () use ($request, $allotment) {
                return $allotment->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::allotment::index'))->with('success_message', 'Successfully updated bed allotment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed\BedAllotment  $bedAllotment
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(Bed $bed, BedAllotment $allotment)
    {
        try {
            DB::transaction(function () use ($bed, $allotment) {
                $allotment->delete();
                $bed_currently = $bed->bed_currently + 1;
                $bed_usage = $bed->bed_usage - 1;
                $bed->update([
                    'bed_currently' => $bed_currently,
                    'bed_usage' => $bed_usage
                ]);
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::allotment::index'))->with('success_message', 'Successfully deleted bed allotment');
    }
}
