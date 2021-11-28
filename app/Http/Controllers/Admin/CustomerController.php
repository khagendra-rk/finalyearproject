<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
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
            'email'   => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'max:10'],
            'address' => ['required'],
            'shopname' => ['required'],
            'bank_name' => ['required'],
            'bank_branch' => ['required'],
            'account_number' => ['required'],
            'account_holder' => ['required'],
        ]);
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->shopname = $request->shopname;
        $customer->bank_name = $request->bank_name;
        $customer->bank_branch = $request->bank_branch;
        $customer->account_number = $request->account_number;
        $customer->account_holder = $request->account_holder;
        $customer->save();
        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'    => ['required', 'min:2', 'max:50'],
            'email'   => ['required', 'email', 'unique:customers,email,' . $customer->id],
            'phone' => ['required', 'max:10'],
            'address' => ['required'],
            'shopname' => ['required'],
            'bank_name' => ['required'],
            'bank_branch' => ['required'],
            'account_number' => ['required'],
            'account_holder' => ['required'],
        ]);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->shopname = $request->shopname;
        $customer->bank_name = $request->bank_name;
        $customer->bank_branch = $request->bank_branch;
        $customer->account_number = $request->account_number;
        $customer->account_holder = $request->account_holder;
        $customer->save();
        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer Information has been Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer has been deleted succesfully!');
    }
}
