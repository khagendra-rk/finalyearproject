<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
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
            'email'   => ['required', 'email', 'unique:suppliers,email'],
            'phone' => ['required', 'max:10'],
            'address' => ['required'],
            'shopname' => ['required'],
            'type' => ['required'],
            'bank_name' => ['required'],
            'bank_branch' => ['required'],
            'account_number' => ['required'],
            'account_holder' => ['required'],
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $supplier->type = $request->type;
        $supplier->bank_name = $request->bank_name;
        $supplier->bank_branch = $request->bank_branch;
        $supplier->account_number = $request->account_number;
        $supplier->account_holder = $request->account_holder;
        $supplier->save();
        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'    => ['required', 'min:2', 'max:50'],
            'email'   => ['required', 'email', 'unique:suppliers,email,' . $supplier->id],
            'phone' => ['required', 'max:10'],
            'address' => ['required'],
            'shopname' => ['required'],
            'type' => ['required'],
            'bank_name' => ['required'],
            'bank_branch' => ['required'],
            'account_number' => ['required'],
            'account_holder' => ['required'],
        ]);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $supplier->type = $request->type;
        $supplier->bank_name = $request->bank_name;
        $supplier->bank_branch = $request->bank_branch;
        $supplier->account_number = $request->account_number;
        $supplier->save();
        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier has been deleted succesfully!');
    }
}
