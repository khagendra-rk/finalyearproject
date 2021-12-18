<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
    ];

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
        $employees = Employee::all();

        return view('admin.salaries.create', compact('employees'));
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
            'emp_id'            => ['required'],
            'month'             => ['required'],
            'year'              => ['required', 'integer', 'min:' . now()->format('Y')],
            'advanced_salary'   => ['required'],
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
        $months = $this->months;

        return view('admin.salaries.edit', compact('salary', 'months'));
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
            'advanced_salary' => ['required', 'integer'],
        ]);

        $salary->update([
            'emp_id' => $request->emp_id,
            'month' => $request->month,
            'year' => $request->year,
            'advanced_salary' => $request->advanced_salary,
        ]);

        return redirect()
            ->route('admin.salaries.index')
            ->with('danger', 'Advanced salalry has been already paid in this month!');
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
    public function paySalary()
    {
        $employees = Employee::get();

        return view('admin.salaries.pay', compact('employees'));
    }

    public function payEmployee(Employee $employee)
    {
        // Show Salary History of 6 Month + 1 Month Ahead
        $datetime = now()->addMonths(1);
        $salaries = [];
        for ($x = 0; $x < 7; $x++) {
            $month = $datetime->format('F');
            $year = $datetime->format('Y');
            $paid_salaries = Salary::query()
                ->where('emp_id', $employee->id)
                ->where('month', $month)
                ->where('year', $year)
                ->get();
            $total_paid = 0;
            foreach ($paid_salaries as $ps) {
                $total_paid = $total_paid + $ps->advanced_salary;
            }

            $to_pay = $employee->salary - $total_paid;
            $salaries[] = [
                'year' => $year,
                'month' => $month,
                'total_paid' => $total_paid,
                'to_pay' => $to_pay,
                'percent' => (int) ($to_pay / $employee->salary * 100),
            ];

            $datetime = $datetime->subMonth(1);
        }

        return view('admin.salaries.employee', compact('employee', 'salaries'));
    }

    public function payAdvance(Request $request)
    {
        $request->validate([
            'emp_id'            => ['required', 'exists:employees,id'],
            'month'             => ['required'],
            'year'              => ['required', 'integer', 'min:' . now()->format('Y')],
            'advanced_salary'   => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $month = $request->month;
        $employee = Employee::find($request->emp_id);

        $salary_check = Salary::where('month', $month)
            ->where('emp_id', $employee->id)
            ->get();

        $paid_salary = 0;
        foreach ($salary_check as $item) {
            $paid_salary = $paid_salary + $item->advanced_salary;
        }
        $per = (int) $request->advanced_salary;
        $to_pay = $employee->salary * ($per / 100);

        // Calculate Amount to Pay
        $remaining = $employee->salary - $paid_salary;
        if ($remaining <= 0 || $remaining < $to_pay) {
            return redirect()
                ->route('admin.salaries.pay')
                ->with('error', 'Rs. ' . $paid_salary . ' has already been paid to employee! They can only receive Rs. ' . $remaining . ' salary! ' . $per . '% of salary amounts to Rs. ' . $to_pay . '!');
        }

        $salaries = new Salary;
        $salaries->emp_id = $request->emp_id;
        $salaries->month = $request->month;
        $salaries->year = $request->year;
        $salaries->advanced_salary = $to_pay;
        $salaries->save();

        return redirect()
            ->route('admin.salaries.index')
            ->with('success', 'Advanced salary has been added successfully!');
    }
}
