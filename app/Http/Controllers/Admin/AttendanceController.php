<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Psy\Command\WhereamiCommand;

class AttendanceController extends Controller
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
        $attendances = DB::table('attendances')->select('edit_date')->groupBy('edit_date')->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.attendances.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->attendance_date;
        $attendance_date = DB::table('attendances')->where('attendance_date', $date)->first();
        if ($attendance_date) {
            return redirect()->back()->with('error', 'Today Attendance has taken already!');
        } else {
            foreach ($request->employee_id as $id) {
                $data[] = [
                    "employee_id" => $id,
                    "status" => $request->status[$id],
                    "attendance_date" => $request->attendance_date,
                    "attendance_month" => $request->attendance_month,
                    "attendance_year" => $request->attendance_year,
                    "attendance_day" => $request->attendance_day,
                    "edit_date" => date("m/d/Y"),
                ];
            }
            $attendance = DB::table('attendances')->insert($data);
            return redirect()
                ->route('admin.attendances.index')
                ->with('success', 'Attendance has taken successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('admin.attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $date = DB::table('attendances')->where('edit_date', $attendance)->first();
        $data = DB::table('attendances')->where('edit_date', $attendance)->get();
        return view('admin.attendances.edit', compact('data', 'date'));
    }



    public function attendanceEdit(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
        ]);

        $attendances = Attendance::where('edit_date', $request->date)->get();

        $date = $request->date;

        return view('admin.attendances.attendance-edit', compact('attendances', 'date'));
    }

    public function attendanceUpdate(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'record' => ['array'],
            'record.*.id' => ['exists:attendances,id'],
            'record.*.status' => [Rule::in(['Present', 'Absent'])],
        ]);

        foreach ($request->record as $item) {
            $attendance = Attendance::find($item['id']);
            if ($attendance) {
                $attendance->update(['status' => $item['status']]);
            }
        }

        return redirect()->route('admin.attendances.index')
            ->with('success', 'Attendance Details Updated!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        foreach ($request->id as $id) {
            $data = [
                "status" => $request->status[$id],
                "attendance_date" => $request->attendance_date,
                "attendance_month" => $request->attendance_month,
                "attendance_year" => $request->attendance_year,
            ];
            $attendance = Attendance::where(['attendance_date' => $request->attendance_date, 'id' => $id])->first();
            $attendance->update($data);
        }
        return redirect()
            ->route('admin.attendances.index')
            ->with('success', 'Attendance has updated successfully!');
    }

    public function viewAttendance($edit_date)
    {
        $date = DB::table('attendances')->where('edit_date', $edit_date)->first();
        $data = DB::table('attendances')->where('edit_date', $edit_date)->get();
        return view('admin.attendances.view', compact('data', 'date'));
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()
            ->route('admin.attendances.index')
            ->with('success', 'Attendance has been deleted succesfully!');
    }

    public function monthly(Request $request)
    {
        $request->validate([
            'year' => ['nullable', 'integer'],
        ]);

        $month = now()->format('F');
        $year = now()->format('Y');

        if (!empty($request->month)) {
            $month = $request->month;
        }

        if (!empty($request->year)) {
            $month = (int) $request->year;
        }

        if ($month == now()->format('F') && $year = now()->format('Y')) {
            $days = now()->format('d');
        } else {
            $is_31 = ['January', 'March', 'May', 'July', 'August', 'October', 'December'];
            if ($month == "February") {
                if ($this->leapYear($year)) {
                    $days = 29;
                } else {
                    $days = 28;
                }
            } else {
                if (in_array($month, $is_31)) {
                    $days = 31;
                } else {
                    $days = 30;
                }
            }
        }
        $employees = Employee::all();
        $all_data = [];
        for ($i = 1; $i <= $days; $i++) {
            $emp_data = [];
            foreach ($employees as $emp) {
                $att = Attendance::query()
                    ->where('employee_id', $emp->id)
                    ->where('attendance_month', $month)
                    ->where('attendance_year', $year)
                    ->where('attendance_day', $i)
                    ->first();

                $status = "-";
                if ($att) {
                    $status = $att->status;
                }

                $emp_data[] = [
                    'employee' => $emp,
                    'name' => $emp->name,
                    'status' => $status,
                ];
            }
            $all_data[] = ['day' => $i, 'employees' => $emp_data];
        }
        $months = $this->months;

        return view('admin.attendances.monthly', compact('all_data', 'year', 'month', 'months', 'employees'));
    }

    public function leapYear($my_year)
    {
        if ($my_year % 400 == 0 || $my_year % 4 == 0)
            return true;
        return false;
    }
}
