<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'min:2', 'max:50'],
            'email'   => ['required', 'email', 'unique:employees,email'],
            'phone' => ['required', 'integer', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'salary' => ['required', 'integer', 'gte:1'],
            'experience' => ['required'],

        ], ['regex' => 'Phone number must start with 98 or 97 and must be 10 digits!']);
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->experience = $request->experience;
        $employee->save();
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'    => ['required', 'min:2', 'max:50'],
            'email'   => ['required', 'email', 'unique:employees,email,' . $employee->id],
            'phone' => ['required', 'integer', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'address' => ['required'],
            'salary' => ['required', 'integer', 'gte:1'],
            'experience' => ['required'],

        ], ['regex' => 'Phone number must start with 98 or 97 and must be 10 digits!']);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->experience = $request->experience;
        $employee->save();
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee Information has been Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee has been deleted succesfully!');
    }
}
