<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['price'] = $request->price;
        $data['weight'] = $request->weight;


        $add = Cart::add($data);
        return redirect()
            ->back()
            ->with('success', 'Product added in cart successfully!');
    }
    public function updateCart(Request $request, $rowId)
    {
        $qty = $request->qty;

        $cart = Cart::get($rowId);
        $product = Product::find($cart->id)->withSum('stocks', 'quantity')->first();
        if ($product->stocks_sum_quantity < $qty) {
            return redirect()->back()->with('error', 'There are not enough items in stock!');
        }

        $update = Cart::update($rowId, $qty);
        return redirect()
            ->back()
            ->with('success', 'Product updated in cart successfully!');
    }
    public function removeCart($rowId)
    {
        $remove = Cart::remove($rowId);
        return redirect()
            ->back()
            ->with('success', 'Product removed in cart successfully!');
    }
    public function createInvoice(Request $request)
    {
        $request->validate(
            [
                'id'    => 'required',
            ],
            [
                'id.required' => 'Select A Customer First!'
            ]
        );
        $id = $request->id;
        $customer = DB::table('customers')->where('id', $id)->first();
        $contents = Cart::content();
        $products = DB::table('products')->get();
        return view("admin.pos.invoice", compact('customer', 'contents', 'products'));
    }
    public function finalInvoice(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;

        $order_id = DB::table('orders')->insertGetId($data);
        $contents = Cart::content();
        $odata = array();
        foreach ($contents as $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->id;
            $odata['quantity'] = $content->qty;
            $odata['rate'] = $content->price;
            $odata['total'] = $content->total;
            Stock::create([
                'product_id' => $content->id,
                'quantity' => $content->qty * -1,
                'remarks' => 'From Order: ' . $order_id,
            ]);
            $insert = DB::table('orderdetails')->insert($odata);
        }
        if ($insert) {
            Cart::destroy();
            return redirect()
                ->route('admin.pending.orders')
                ->with('success', 'Invoice created successfully! || Please deliver the products and accept status');
        }
    }
}
