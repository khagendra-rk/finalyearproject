<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $customers_count = Customer::count();
        $employees_count = Employee::count();
        $date = date('d/m/y');
        $today_expenses = Expense::where('date', $date)->sum('amount');

        $suppliers_count = Supplier::count();
        $products_count = Product::count();
        $orders_count = DB::table('orders')->count();

        return view('admin.index', compact('users_count', 'customers_count', 'employees_count', 'today_expenses', 'suppliers_count', 'products_count', 'orders_count'));
    }
}
