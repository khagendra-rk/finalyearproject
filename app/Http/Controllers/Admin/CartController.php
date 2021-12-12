<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

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
}
