<?php

namespace App\Http\Controllers\Admin\Bed;

use App\Http\Controllers\Controller;
use App\Models\Bed\Bed;
use App\Models\Bed\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = DB::transaction(function () {
            return Bed::paginate(20);
        }, 5);

        return view('admin.bed.index', [
            'beds' => $beds
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = DB::transaction(function () {
            return Type::all();
        }, 5);

        return view('admin.bed.create', [
            'types' => $types
        ]);
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
            'bed_number' => 'required',
            'bed_type_id' => 'required|numeric',
            'total_bed' => 'required|numeric'
        ]);

        DB::transaction(function () use ($request) {
            return Bed::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::index'))->with('success_message', 'Succesfully create add new bed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        return view('admin.bed.show', [
            'bed' => $bed
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Bed $bed)
    {
        $types = DB::transaction(function () {
            return Type::all();
        }, 5);

        return view('admin.bed.edit', [
            'bed' => $bed,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed)
    {
        $this->validate($request, [
            'bed_number' => 'required',
            'bed_type_id' => 'required|numeric',
            'total_bed' => 'required|numeric'
        ]);

        try {
            DB::transaction(function () use ($request, $bed) {
                return $bed->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::index'))->with('success_message', 'Succesfully updated bed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bed $bed)
    {
        try {
            DB::transaction(function () use ($bed) {
                $bed->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::bed::index'))->with('success_message', 'Succesfully deleted bed');
    }
}
