<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\Department\DepartmentFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Department\Department $department
     * @return \Illuminate\Http\Response
     */
    public function index(Department $department)
    {
        $departmentFacilities = DB::transaction(function () use ($department) {
            return DepartmentFacility::where('department_id', $department->id)
                                    ->paginate(10);
        });

        return view('admin.department.facilities.index', [
            'department' => $department,
            'departmentFacilities' => $departmentFacilities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Department\Department $department
     * @return \Illuminate\Http\Response
     */
    public function create(Department $department)
    {
        return view('admin.department.facilities.create', [
            'department' => $department
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {
        $this->validate($request, ['title' => 'required']);

        DB::transaction(function () use ($request) {
            return DepartmentFacility::create($request->all());
        }, 5);

        return redirect(route('admin::department::facility::index', [
            'department' => $department
        ]))->with('success_message', 'Successfully add department facility');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department\DepartmentFacility  $departmentFacility
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentFacility $departmentFacility, Department $department)
    {
        return view('admin.department.facilities.show', [
            'departmentFacility' => $departmentFacility,
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department\DepartmentFacility  $departmentFacility
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentFacility $departmentFacility, Department $department)
    {
        return view('admin.department.facilities.edit', [
            'departmentFacility' => $departmentFacility,
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department\DepartmentFacility  $departmentFacility
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentFacility $departmentFacility, Department $department)
    {
        $this->validate($request, ['title' => 'required']);

        DB::transaction(function () use ($request, $departmentFacility) {
            return $departmentFacility->update($request->all());
        }, 5);

        return redirect(route('admin::department::facility::index', [
            'department' => $department->id
        ]))->with('success_message', 'Successfully updated department facility');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department\DepartmentFacility  $departmentFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department, $departmentFacility)
    {
        DB::transaction(function () use ($departmentFacility) {
            $departmentFacility = DepartmentFacility::find($departmentFacility);
            return $departmentFacility->delete();
        }, 5);

        return redirect()->back()
                ->with('success_message', 'Successfully updated department facility');
    }
}
