<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Redirect;



class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $departments = Department::orderBy('name');
        return view(
            'departments.index',
            [
                'departments' => $departments
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->code = $request->code;
        $department->save();
        return redirect()->route('departments.index')->with('sucess');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::all();

        return view('departments.show', ['departments' => $department]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update logic
        $department = Student::find($id);
        $department->name = $request->input('name');
        $department->code = $request->input('code');
        $department->update();
        return redirect()->route('departments.index')->with('sucess');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        if (empty($department)) {
            abort(404);
        }
        $department->delete();
        return redirect()->route('departments.index');
    }
}
