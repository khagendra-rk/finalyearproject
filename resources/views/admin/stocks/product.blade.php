@extends('adminlte::page')
@section('title', 'Stocks for Product')

@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Stock for Product: {{ $product->name }}</h3>
           <div class="card-tools">
            <a class="btn btn-info btn-sm" href="{{ route('admin.stocks.index') }}">
             <i class="fas fa-arrow-circle-left fa-fw mr-1"></i> Go Back</a>
        </div>
       </div>
       <div class="card-body">
           Current Stock: <b>{{ $product->stocks_sum_quantity ?? 0 }}</b>
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Quantity</th>
                       <th>Remarks</th>
                       <th>Date</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($stocks as $stock )
               <tr>
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