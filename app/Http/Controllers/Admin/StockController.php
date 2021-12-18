<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::orderBy('id', 'DESC')->with('product')->get();

        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.stocks.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'remarks' => ['nullable', 'string'],
        ]);

        if ($request->quantity < 0) {
            $product = Product::find($request->product_id)->withSum('stocks', 'quantity')->first();
            if ($product && $product->stocks_sum_quantity < abs($request->quantity)) {
                return redirect()->route('admin.stocks.create')
                    ->with('error', abs($request->quantity) . ' amount of items is not available on stock!');
            }
        }

        Stock::create($data);

        return redirect()->route('admin.stocks.index')
            ->with('success', 'Stock added!');
    }

    public function product(Product $product)
    {
        $product->loadSum('stocks', 'quantity');
        $stocks = Stock::where('product_id', $product->id)->orderBy('id', 'DESC')->get();

        return view('admin.stocks.product', compact('product', 'stocks'));
    }
}
