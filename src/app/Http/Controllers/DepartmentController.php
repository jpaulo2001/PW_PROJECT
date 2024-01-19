<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Redirect;
use App\Services\DocumentPermitionService;
use App\Services\DepartmentService;




namespace App\Http\Controllers;

use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    // Inject DepartmentService
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        // Get departments from service
        $departments = $this->departmentService->getAllDepartments();
        // Return departments view with data
        return view('departments.index', ['departments' => $departments]);
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'code']);
        $this->departmentService->createDepartment($data);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function show($id)
    {
        $department = $this->departmentService->getDepartmentById($id);

        return view('departments.show', ['department' => $department]);
    }

    public function edit($id)
    {
        $department = $this->departmentService->getDepartmentById($id);

        return view('departments.edit', ['department' => $department]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'code']);
        $this->departmentService->updateDepartment($id, $data);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $this->departmentService->deleteDepartment($id);

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
