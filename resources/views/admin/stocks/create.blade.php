@extends('adminlte::page')
@section('title', 'Add New Stocks')

@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Add New Stocks</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.stocks.index') }}">
                <i class="fas fa-arrow-circle-left fa-fw mr-1"></i> Go Back</a>
           </div>
       </div>
       <div class="card-body">
           <form action="{{ route('admin.stocks.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id" class="form-control">
                        <option value="">Choose one...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity') }}">
                </div>

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="text" class="form-control" name="remarks" id="remarks" value="{{ old('quantity') }}">
                </div>

                <button type="submit" class="btn btn-primary">Add Stock</button>
            </form>
       </div>
   </div>
@stop