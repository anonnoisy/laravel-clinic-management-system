<?php

namespace App\Http\Controllers\Admin\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Medicine\Category;
use App\Models\Medicine\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = DB::transaction(function () {
            return Medicine::all();
        }, 5);

        return view('admin.medicine.index', [
            'medicines' => $medicines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::transaction(function () {
            return Category::all();
        }, 5);

        return view('admin.medicine.create', [
            'categories' => $categories
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
        try {
            DB::transaction(function () use ($request) {
                $medicine = new Medicine;
                $medicine->name = $request->name;
                $medicine->price = $request->price;
                $medicine->quantity = $request->quantity;
                $medicine->manufacture_company = $request->manufacture_company;
                $medicine->description = $request->description;
                $medicine->status = $request->status;
                $medicine->save();
    
                $medicine->category()->attach($request->category_id);
            }, 5);
        } catch (\Exception $e) {
            return redirect(route('admin::medicine::index'))->with('success_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::index'))->with('success_message', 'Successfully create new medicine');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        return view('admin.medicine.show', [
            'medicine' => $medicine
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $categories = DB::transaction(function () {
            return Category::all();
        }, 5);

        return view('admin.medicine.edit', [
            'categories' => $categories,
            'medicine' => $medicine
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        DB::transaction(function () use ($request) {
            $medicine = new Medicine;
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->quantity = $request->quantity;
            $medicine->manufacture_company = $request->manufacture_company;
            $medicine->description = $request->description;
            $medicine->status = $request->status;
            $medicine->save();

            $medicine->category()->detach();
            $medicine->category()->attach($request->category_id);
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect(route('admin::medicine::index'))->with('success_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::index'))->with('success_message', 'Successfully updated medicine');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try {
            DB::transaction(function () use ($medicine) {
                $medicine->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect(route('admin::medicine::index'))->with('success_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::index'))->with('success_message', 'Successfully deleted medicine');
    }
}
