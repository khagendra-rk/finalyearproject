@extends('adminlte::page')

@section('title', 'Add Expenses')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Add Expense</h3>
        <div class="card-tools mr-1">
            <a class="btn btn-success btn-sm mr-1" href="{{ route('admin.expenses.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
        <div class="card-tools mr-1">
            <a class="btn btn-info btn-sm mr-1" href="{{ route('admin.expenses.today') }}">Today</a>
            <a class="btn btn-warning btn-sm mr-1" href="{{ route('admin.expenses.monthly') }}">This Month</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.expenses.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="details">Expense Details</label>
        <input type="text" name="details" id="details" class="form-control @error('details') is-invalid           
        @endif" value="{{ old('details')??'' }}" required>
        @error('details')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" class="form-control @error('amount') is-invalid           
        @endif" value="{{ old('amount')??'' }}" required>
        @error('amount')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="month" id="month" class="form-control @error('month') is-invalid           
        @endif" value="{{ date("F")??old('month')??'' }}" required>
        @error('month')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="date" id="date" class="form-control @error('date') is-invalid           
        @endif" value="{{ date("d/m/y")??old('date')??'' }}" required>
        @error('date')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="year" id="year" class="form-control @error('year') is-invalid           
        @endif" value="{{ date("Y")??old('date')??'' }}" required>
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <input type="submit"  class="btn btn-primary" value="Add Expense">
</form>
</div>
@stop 