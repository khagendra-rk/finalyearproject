<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function takeAttendance()
    {
        $user = DB::table('employees')->get();
        return view('admin.attendances.take');
    }
}
