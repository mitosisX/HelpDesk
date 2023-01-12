<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $id = Department::create($request->validated())->id;

        // Department::find($id)
        //     ->update(['name' => $request->name]);

        return response()
            ->json(['id' => $id]);

        // return redirect()
        //     ->route('manager.departments.index')
        //     ->with('department_status', 'create succefully!');
    }

    public function storeJSON(DepartmentRequest $request)
    {
        $id = Department::create($request->validated())->id;

        // Department::find($id)
        //     ->update(['name' => $request->name]);

        return response()
            ->json(['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('manager.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $department)
    {
        Department::find($department->id)
            ->update($request->validated());

        return redirect()
            ->route('manager.departments.index')
            ->with('department_status', 'Updated succefully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($department)
    {
        return "sdsds";
    }

    public function delete(Department $department)
    {
        $department->delete();
        return redirect()
            ->route('manager.departments.index');
    }

    public function updateDepartmentJson(Request $request, $id)
    {
        Department::find($id)
            ->update(['name' => $request->name]);

        return response()
            ->json(['success' => true]);
    }

    public function deleteDepartmentJson(Department $department)
    {
        $department->delete();

        return response()
            ->json(['success' => true]);
    }
}
