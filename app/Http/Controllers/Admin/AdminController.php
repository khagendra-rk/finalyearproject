<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // $product = DB::table('products')
        //     ->join('categories', 'products.category_id', 'categories.id')
        //     ->select('categories.cat_name', 'products.*')
        //     ->get();
        // $customer = DB::table('customers')->get();
        // $category = DB::table('categories')->get();
        // return view('admin.pos.index', compact('product', 'customer', 'category'));
        return view('admin.index');
    }
}
