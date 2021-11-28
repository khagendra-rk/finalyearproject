@extends('adminlte::page')

@section('title', 'Edit Advanced Salary')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Edit Advanced Salary</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.salaries.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.salaries.update',$salary->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Employee</label>
        @php
            $emp=DB::table('employees')->get();
        @endphp
        <select name="emp_id" class="form-control">
            <option disabled="" selected="">Choose one...</option>
                @foreach ($emp as $row)
                    <option value="{{ $row->id }}"<?php if($salary->emp_id==$row->id){echo "selected";}?>>{{ $row->name }}</option>
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
            <option disabled="" selected="">Choose one...</option>
            @foreach($months as $month)
                <option value="{{ $month }}" @if($month == $salary->month) selected @endif>{{ $month }}</option>
            @endforeach
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
        @endif" value="{{ old('year')??$salary->year }}">
        @error('year')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="advanced_salary">Advanced Salary</label>
        <input type="text" name="advanced_salary" id="advanced_salary" class="form-control @error('advanced_salary') is-invalid           
        @endif" value="{{ old('advanced_salary')??$salary->advanced_salary }}">
        @error('advanced_salary')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <input type="submit"  class="btn btn-primary" value="Update">
</form>
</div>
@stop 