<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $salaries = DB::table('salaries')
        //     ->join('employees', 'salaries.emp_id', 'employees.id')
        //     ->select('salaries.*', 'employees.name', 'employees.salary')
        //     ->orderBy('id', 'DESC')
        //     ->get();

        $salaries = Salary::with('employee')->get();
        return view('admin.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salaries.create');
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
            'emp_id'    => ['required'],
            'month'   => ['required'],
            'year'   => ['required'],
            'advanced_salary' => ['required'],

        ]);
        $month = $request->month;
        $emp_id = $request->emp_id;
        $salaries = DB::table('salaries')
            ->where('month', $month)
            ->where('emp_id', $emp_id)
            ->first();
        if ($salaries == NULL) {
            $salaries = new Salary;
            $salaries->emp_id = $request->emp_id;
            $salaries->month = $request->month;
            $salaries->year = $request->year;
            $salaries->advanced_salary = $request->advanced_salary;
            $salaries->save();
            return redirect()
                ->route('admin.salaries.index')
                ->with('success', 'Advanced salalry has been added successfully!');
        } else {
            return redirect()
                ->route('admin.salaries.index')
                ->with('danger', 'Advanced salalry has been already paid in this month!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        return view('admin.salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        return view('admin.salaries.edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'emp_id'    => ['required'],
            'month'   => ['required'],
            'year'   => ['required'],
            'advanced_salary' => ['required' . $salary->id],

        ]);
        $month = $request->month;
        $emp_id = $request->emp_id;
        $salaries = DB::table('salaries')
            ->where('month', $month)
            ->where('emp_id', $emp_id)
            ->first();
        if ($salaries == NULL) {
            $salaries = new Salary;
            $salaries->emp_id = $request->emp_id;
            $salaries->month = $request->month;
            $salaries->year = $request->year;
            $salaries->advanced_salary = $request->advanced_salary;
            $salaries->save();
            return redirect()
                ->route('admin.salaries.index')
                ->with('success', 'Advanced salalry has been updated successfully!');
        } else {
            return redirect()
                ->route('admin.salaries.index')
                ->with('danger', 'Advanced salalry has been already paid in this month!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()
            ->route('admin.salaries.index')
            ->with('success', 'Advanced Salary has been deleted succesfully!');
    }
    public function PaySalary()
    {
        $salaries = Salary::with('employee')->get();
        return view('admin.salaries.pay', compact('salaries'));
        // dd("paysalary");
        // $month = date("F", strtotime('-1 month'));
        // $salaries = DB::table('salaries')
        //     ->join('employees', 'salaries.emp_id', 'employees.id')
        //     ->select('salaries.*', 'employees.name', 'employees.salary')
        //     ->where('month', $month)
        //     ->get();
        // return view('admin.salaries.pay', compact('salaries'));
    }
}
