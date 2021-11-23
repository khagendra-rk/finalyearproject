@extends('adminlte::page')

@section('title', 'Add New Employees')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Edit User:{{ $employee->name }}</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.employees.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.employees.update',$employee->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid           
        @endif" value="{{ old('name')??$employee->name}}">
        @error('name')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid           
        @endif" value="{{ old('email')??$employee->email }}">
        @error('email')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid           
        @endif" value="{{ old('phone')??$employee->phone }}">
        @error('phone')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid           
        @endif" value="{{ old('address')??$employee->address }}">
        @error('address')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid           
        @endif" value="{{ old('salary')??$employee->salary }}">
        @error('salary')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="experience">Experience</label>
        <input type="text" name="experience" id="experience" class="form-control @error('experience') is-invalid           
        @endif" value="{{ old('experience')??$employee->experience }}">
        @error('experience')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus fa-fw mr-1"></i>Create New Employee
    </button> --}}
    <input type="submit"  class="btn btn-primary" value="Update Employee">
</form>
</div>
@stop 