@extends('adminlte::page')

@section('title', 'Add product')
@section('plugins.Select2',true)
@section('js')
<script>
$(document).ready(function() {
    $('#role').select2();
});
</script>
@endsection
@section('content')
<x-alert/>
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Add new product</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.products.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.products.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid           
        @endif" value="{{ old('product_name')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="product_code">Product Code</label>
        <input type="text" name="product_code" id="product_code" class="form-control @error('product_code') is-invalid           
        @endif" value="{{ old('product_code')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        @php
            $cat=DB::table('categories')->get();
        @endphp
        <select name="category_id" class="form-control">
            <option disabled="" selected=""></option>
                @foreach ($cat as $row)
                    <option value="{{ $row->id }}">{{ $row->cat_name }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="supplier_id">Supplier</label>
        @php
            $sup=DB::table('suppliers')->get();
        @endphp
        <select name="supplier_id" class="form-control">
            <option disabled="" selected=""></option>
                @foreach ($sup as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_place">Product Place</label>
        <input type="text" name="product_place" id="product_place" class="form-control @error('product_place') is-invalid           
        @endif" value="{{ old('product_place')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="buy_date">Buying Date</label>
        <input type="date" name="buy_date" id="buy_date" class="form-control @error('buy_date') is-invalid           
        @endif" value="{{ old('buy_date')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="expire_date">Expire Date</label>
        <input type="date" name="expire_date" id="expire_date" class="form-control @error('expire_date') is-invalid           
        @endif" value="{{ old('expire_date')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="buying_price">Buying Price</label>
        <input type="text" name="buying_price" id="buying_price" class="form-control @error('buying_price') is-invalid           
        @endif" value="{{ old('buying_price')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>    <div class="form-group">
        <label for="selling_price">Selling Price</label>
        <input type="text" name="selling_price" id="selling_price" class="form-control @error('v') is-invalid           
        @endif" value="{{ old('selling_price')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <input type="submit"  class="btn btn-primary" value="Add Product">
</form>
</div>
@stop 