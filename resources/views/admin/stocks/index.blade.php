@extends('adminlte::page')
@section('title', 'All Stocks')

@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Stocks</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.stocks.create') }}">
                <i class="fas fa-plus-circle fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Product Name</th>
                       <th>Quantity</th>
                       <th>Remarks</th>
                       <th>Date</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($stocks as $stock )
               <tr>
                   <td>
                       <a href="{{ route('admin.products.stock', $stock->product_id) }}">
                            <b>{{ $stock->product->product_name }}</b>
                        </a>
                   </td>
                   <td>{{ $stock->quantity }}</td>
                   <td>{{ $stock->remarks }}</td>
                   <td>{{ $stock->created_at }}</td>
               </tr>
               @endforeach
            </tbody>
           </table>
       </div>
   </div>
@stop