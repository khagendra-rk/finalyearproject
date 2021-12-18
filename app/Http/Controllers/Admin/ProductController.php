<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'supplier')->withSum('stocks', 'quantity')->get();
        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.create");
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
            'product_name'    => ['required'],
            'product_code'   => ['required'],
            'category_id'   => ['required'],
            'supplier_id' => ['required'],
            'product_place' => ['required'],
            'buy_date' => ['required', 'date'],
            'expire_date' => ['required', 'date', 'after:buy_date', 'after:' . now()],
            'buying_price' => ['required'],
            'selling_price' => ['required'],
        ]);
        $products = new Product;
        $products->product_name = $request->product_name;
        $products->product_code = $request->product_code;
        $products->category_id = $request->category_id;
        $products->supplier_id = $request->supplier_id;
        $products->product_place = $request->product_place;
        $products->buy_date = $request->buy_date;
        $products->expire_date = $request->expire_date;
        $products->buying_price = $request->buying_price;
        $products->selling_price = $request->selling_price;
        $products->save();
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'    => ['required'],
            'product_code'   => ['required'],
            'category_id'   => ['required'],
            'supplier_id' => ['required'],
            'product_place' => ['required'],
            'buy_date' => ['required'],
            'expire_date' => ['required'],
            'buying_price' => ['required'],
            'selling_price' => ['required'],
        ]);
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_place = $request->product_place;
        $product->buy_date = $request->buy_date;
        $product->expire_date = $request->expire_date;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->save();
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product has been update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Products has been deleted succesfully!');
    }
    public function importProduct()
    {
        return view('admin.products.import');
    }
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    public function import(Request $request)
    {
        $import = Excel::import(new ProductsImport, $request->file('import_file'));
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Products import succesfully!');
    }
}
