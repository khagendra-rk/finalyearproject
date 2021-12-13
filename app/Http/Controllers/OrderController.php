<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $pending = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('order_status', 'pending')->get();
        return view("admin.orders.pending", compact('pending'));
    }
    public function viewOrder($id)
    {

        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('orders.id', $id)->first();

        $order_details = DB::table('orderdetails')
            ->join('products', 'orderdetails.product_id', 'products.id')
            ->select('orderdetails.*', 'products.product_name', 'products.product_code')
            ->where('order_id', $id)
            ->get();
        // echo "<pre>";
        // print_r($order_details);
        return view('admin.orders.confirmation', compact('order', 'order_details'));
    }
    public function confirmOrder($id)
    {
        $approve = DB::table('orders')->where('id', $id)->update(['order_status' => 'success']);
        return redirect()
            ->route('admin.pending.orders')
            ->with('success', 'Order confirmed successfully! & All Products Delivered!');
    }
    public function successOrder()
    {
        $success = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('order_status', 'success')
            ->get();
        return view('admin.orders.success', compact('success'));
    }
}
