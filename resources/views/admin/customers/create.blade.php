@extends('adminlte::page')

@section('title', 'Add New Customer')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Create New Customer</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.customers.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.customers.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid           
        @endif" value="{{ old('name')??'' }}">
        @error('name')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid           
        @endif" value="{{ old('email')??'' }}">
        @error('email')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid           
        @endif" value="{{ old('phone')??'' }}">
        @error('phone')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid           
        @endif" value="{{ old('address')??'' }}">
        @error('address')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="shopname">Shop Name</label>
        <input type="text" name="shopname" id="shopname" class="form-control @error('shopname') is-invalid           
        @endif" value="{{ old('shopname')??'' }}">
        @error('shopname')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="bank_name">Bank Name</label>
        <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid           
        @endif" value="{{ old('bank_name')??'' }}">
        @error('bank_name')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="bank_branch">Branch Name</label>
        <input type="text" name="bank_branch" id="bank_branch" class="form-control @error('bank_branch') is-invalid           
        @endif" value="{{ old('bank_branch')??'' }}">
        @error('bank_branch')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="account_number">Account no.</label>
        <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid           
        @endif" value="{{ old('account_number')??'' }}">
        @error('account_number')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="account_holder">Acoount Holder Name</label>
        <input type="text" name="account_holder" id="account_holder" class="form-control @error('account_holder') is-invalid           
        @endif" value="{{ old('account_holder')??'' }}">
        @error('account_holder')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus fa-fw mr-1"></i>Create New Customer
    </button> --}}
    <input type="submit"  class="btn btn-primary" value="Create New Customer">
</form>
</div>
@stop 