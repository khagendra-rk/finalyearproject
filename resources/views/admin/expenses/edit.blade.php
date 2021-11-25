@extends('adminlte::page')

@section('title', 'Edit Expenes')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Edit Expense:{{ $expense->details }}</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.expenses.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.expenses.update',$expense->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="details">Expense Details</label>
        <input type="text" name="details" id="details" class="form-control @error('details') is-invalid           
        @endif" value="{{ old('details')??$expense->details }}" required>
        @error('details')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" class="form-control @error('amount') is-invalid           
        @endif" value="{{ old('amount')??$expense->amount }}" required>
        @error('amount')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="month" id="month" class="form-control @error('month') is-invalid           
        @endif" value="{{ date("F")??old('month')??$expense->month }}" required>
        @error('month')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="date" id="date" class="form-control @error('date') is-invalid           
        @endif" value="{{ date("d/m/y")??old('date')??$expense->date }}" required>
        @error('date')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <input type="hidden" name="year" id="year" class="form-control @error('year') is-invalid           
        @endif" value="{{ date("Y")??old('year')??$expense->year }}" required>
        @error('date')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <input type="submit"  class="btn btn-primary" value="Update Expense">
</form>
</div>
@stop 