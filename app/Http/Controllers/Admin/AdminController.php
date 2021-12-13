<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // $today = date('m/d/Y');
        // $today_sales = DB::table('orders')->where('order_date', $today)->select('total')->sum('total');
        // echo "<pre>";
        // print_r($today_sales);
        // exit();
        return view('admin.index');
    }
}
