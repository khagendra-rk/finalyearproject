@extends('adminlte::page')

@section('title', 'Succes Orders')
@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Success Orders</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.products.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr class="text-center">
                       <th>Name</th>
                       <th>Order Date</th>
                       <th>Quantity</th>
                       <th> Total Amount</th>
                       <th>Payment Status</th>
                       <th>Order Status</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($success as $row )
               <tr class="text-center">
                   <td>{{ $row->name}}</td>
                   <td>{{ $row->order_date}}</td>
                   <td>{{ $row->total_products}}</td>
                   <td>{{ $row->total}}</td>
                   <td>{{ $row->payment_status}}</td>
                   <td><span class="badge badge-success">{{ $row->order_status}}</span> </td>
                   <td><a href="{{ route('admin.orders.status',$row->id) }}" class="btn btn-sm btn-primary">View</a></td>
               </tr>
               @endforeach    
            </tbody>                     
           </table>
       </div>
   </div>
@stop