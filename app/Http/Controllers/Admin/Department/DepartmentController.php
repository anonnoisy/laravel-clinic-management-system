<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = DB::transaction(function () {
            return Department::orderBy('name', 'ASC')->paginate(10);
        }, 5);

        return view('admin.department.index', [
            'departments' => $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        DB::transaction(function () use ($request) {
            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/department', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            return Department::create($request->all());
        }, 5);

        return redirect(route('admin::department::index'))
                ->with('success_message', 'Successfulle add new department');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('admin.department.show', [
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.department.edit', [
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, ['name' => 'required']);

        DB::transaction(function () use ($request, $department) {
            $imageUrl = $department->image_url;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/department', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            return $department->update($request->all());
        }, 5);

        return redirect(route('admin::department::index'))
                ->with('success_message', 'Successfully updated department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        DB::transaction(function () use ($department) {
            return $department->delete();
        }, 5);

        return redirect()->back()
                ->with('success_message', 'Successfully deleted department');
    }
}
