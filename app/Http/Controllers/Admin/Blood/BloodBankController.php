<?php

namespace App\Http\Controllers\Admin\Blood;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BloodBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloods = DB::transaction(function () {
            return BloodBank::all();
        }, 5);

        return view('admin.blood.bank.index', [
            'bloods' => $bloods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blood.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'blood_name' => 'required|unique:blood_banks,blood_name',
            'status' => 'required'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $request['is_new'] = TRUE;
                return BloodBank::create($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::blood::bank::index'))->with('success_message', 'Successfully add new blood bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  @param  \App\Models\BloodBank  $blood
     * @return \Illuminate\Http\Response
     */
    public function show(BloodBank $blood)
    {
        return view('admin.blood.bank.show', [
            'blood' => $blood
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  @param  \App\Models\BloodBank  $blood
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodBank $blood)
    {
        return view('admin.blood.bank.edit', [
            'blood' => $blood
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  @param  \App\Models\BloodBank  $blood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodBank $blood)
    {
        $this->validate($request, [
            'blood_name' => 'required|unique:blood_banks,blood_name,' . $blood->id,
            'status' => 'required'
        ]);

        try {
            DB::transaction(function () use ($request, $blood) {
                return $blood->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::blood::bank::index'))->with('success_message', 'Successfully updated blood bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodBank  $blood
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodBank $blood)
    {
        if ($blood->is_new == FALSE) {
            return back()->with('error_message', 'You can\'t deleted this default blood bank');
        }

        try {
            DB::transaction(function () use ($blood) {
                return $blood->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::blood::bank::index'))->with('success_message', 'Successfully deleted blood bank');
    }
}
