@extends('adminlte::page')

@section('title', 'Add Advanced Salary')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Advanced Salary Provide</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.salaries.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.salaries.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Employee</label>
        @php
            $emp=DB::table('employees')->get();
        @endphp
        <select name="emp_id" class="form-control">
            <option disabled="" selected=""></option>
                @foreach ($emp as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
        </select>
        {{-- <input type="text" name="name" id="name" class="form-control @error('name') is-invalid           
        @endif" value="{{ old('name')??'' }}">
        @error('name')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror --}}
    </div>
    <div class="form-group">
        <label for="month">Month</label>
        <select name="month" class="form-control">
            <option disabled="" selected=""></option>
            <option value="January">January</option>
            <option value="Feburary">Feburary</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
        {{-- <input type="email" name="email" id="email" class="form-control @error('email') is-invalid           
        @endif" value="{{ old('email')??'' }}">
        @error('email')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror --}}
    </div>
    <div class="form-group">
        <label for="year">Year</label>
        <input type="text" name="year" id="year" class="form-control @error('year') is-invalid           
        @endif" value="{{ old('year')??'' }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="advanced_salary">Advanced Salary</label>
        <input type="text" name="advanced_salary" id="advanced_salary" class="form-control @error('advanced_salary') is-invalid           
        @endif" value="{{ old('advanced_salary')??'' }}">
        @error('advanced_salary')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus fa-fw mr-1"></i>Create New Employee
    </button> --}}
    <input type="submit"  class="btn btn-primary" value="Add Advanced Salary">
</form>
</div>
@stop 