<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\SupplierController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [SiteController::class, 'home'])->middleware('auth');
Route::get('/logout', [SiteController::class, 'logout']);


//Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::middleware('can:update-users')->group(function () {
        // <----Pos routes are here--->
        Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
        // <----Cart Controller route are here---->compact
        Route::post('/add-cart', [CartController::class, 'addCart'])->name('cart.add');
        Route::post('/update-cart/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');
        Route::get('/remove-cart/{rowId}', [CartController::class, 'removeCart'])->name('cart.remove');
        Route::post('/create-invoice', [CartController::class, 'createInvoice'])->name('create.invoice');



        Route::resource('users', UserController::class)->middleware('can:update-users');
        Route::resource('employees', EmployeeController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::get('salaries/pay', [SalaryController::class, 'paySalary'])->name('salaries.pay');
        Route::resource('salaries', SalaryController::class);
        Route::resource('categories', CategoryController::class);
        // <------Products routes are here---->>
        Route::get('products/import-products', [ProductController::class, 'importProduct'])->name('products.import-products');
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::resource('products', ProductController::class);

        //<-----Today, Monlty, Yearly Expenses route are here------>
        Route::get('expenses/today', [ExpenseController::class, 'todayExpense'])->name('expenses.today');
        Route::get('expenses/monthly', [ExpenseController::class, 'monthlyExpense'])->name('expenses.monthly');
        Route::get('expenses/yearly', [ExpenseController::class, 'yearlyExpense'])->name('expenses.yearly');

        //<-----Monthly expenses route are here------>
        Route::get('expenses/january', [ExpenseController::class, 'januaryExpense'])->name('expenses.january');
        Route::get('expenses/february', [ExpenseController::class, 'februaryExpense'])->name('expenses.february');
        Route::get('expenses/march', [ExpenseController::class, 'marchExpense'])->name('expenses.march');
        Route::get('expenses/april', [ExpenseController::class, 'aprilExpense'])->name('expenses.april');
        Route::get('expenses/may', [ExpenseController::class, 'mayExpense'])->name('expenses.may');
        Route::get('expenses/june', [ExpenseController::class, 'juneExpense'])->name('expenses.june');
        Route::get('expenses/july', [ExpenseController::class, 'julyExpense'])->name('expenses.july');
        Route::get('expenses/august', [ExpenseController::class, 'augustExpense'])->name('expenses.august');
        Route::get('expenses/september', [ExpenseController::class, 'septemberExpense'])->name('expenses.september');
        Route::get('expenses/october', [ExpenseController::class, 'octoberExpense'])->name('expenses.october');
        Route::get('expenses/november', [ExpenseController::class, 'novemberExpense'])->name('expenses.november');
        Route::get('expenses/december', [ExpenseController::class, 'decemberExpense'])->name('expenses.december');

        //<-----Expense route is here----->
        Route::resource('expenses', ExpenseController::class);

        //<---Attendance route are here---->
        Route::get('/attendaces/edit', [AttendanceController::class, 'attendanceEdit'])->name('attendance.edit');
        Route::post('/attendaces/edit', [AttendanceController::class, 'attendanceUpdate'])->name('attendance.update');
        Route::get('attendances/view', [AttendanceController::class, 'viewAttendance'])->name('attendances.view');
        Route::resource('attendances', AttendanceController::class);
    });
});
