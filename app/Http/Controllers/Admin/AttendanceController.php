<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class AttendanceController extends Controller
{
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
        // $request->validate([
        //     'employee_id' => ['required'],
        //     'attendance_date' => ['required'],
        //     'attendance_month' => ['required'],
        //     'attendance_year' => ['required'],
        //     'status' => ['required'],
        // ]);
        // $attendance = new Attendance;
        // $attendance->employee_id = $request->employee_id;
        // $attendance->attendance_date = $request->attendance_date;
        // $attendance->attendance_month = $request->attendance_month;
        // $attendance->attendance_year = $request->attendance_year;
        // $attendance->status = $request->status;
        // $attendance->save();
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
                    "edit_date" => date("d/m/Y"),

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
