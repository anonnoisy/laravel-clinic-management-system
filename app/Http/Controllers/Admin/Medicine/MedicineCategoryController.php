<?php

namespace App\Http\Controllers\Admin\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Medicine\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::transaction(function () {
            return Category::paginate(20);
        });

        return view('admin.medicine.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicine.category.create');
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
                return Category::create($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::category::index'))->with('success_message', 'Successfully create new category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.medicine.category.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.medicine.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            DB::transaction(function () use ($request, $category) {
                return $category->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::category::index'))->with('success_message', 'Successfully updated category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::transaction(function () use ($category) {
                return $category->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again');
        }

        return redirect(route('admin::medicine::category::index'))->with('success_message', 'Successfully deleted category');
    }
}
