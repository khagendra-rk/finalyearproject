<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\OutputInterface;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view("admin.expenses.index", compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.expenses.create");
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
            'details' => ['required'],
            'amount' => ['required'],
            'month' => ['required'],
            'date' => ['required'],
            'year' => ['required'],

        ]);
        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->month = $request->month;
        $expense->date = $request->date;
        $expense->year = $request->year;

        $expense->save();
        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view("amdin.expenses.show", compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view("admin.expenses.edit", compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'details' => ['required'],
            'amount' => ['required'],
            'month' => ['required'],
            'date' => ['required'],
            'year' => ['required'],

        ]);
        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->month = $request->month;
        $expense->date = $request->date;
        $expense->year = $request->year;

        $expense->save();
        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expenses has been deleted succesfully!');
    }
    public function TodayExpense()
    {
        $date = date('d/m/y');
        $today = DB::table('expenses')->where('date', $date)->get();
        $sum = DB::table('expenses')->where('date', $date)->sum('amount');
        return view("admin.expenses.today", compact('today', 'sum'));
    }
}
