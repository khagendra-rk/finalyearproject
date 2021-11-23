@extends('adminlte::page')

@section('title', 'Add Salaries')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Create New Employee</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.employees.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.employees.store') }}" method="post">
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
        <label for="salary">Salary</label>
        <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid           
        @endif" value="{{ old('salary')??'' }}">
        @error('salary')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <div class="form-group">
        <label for="experience">Experience</label>
        <input type="text" name="experience" id="experience" class="form-control @error('experience') is-invalid           
        @endif" value="{{ old('experience')??'' }}">
        @error('experience')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus fa-fw mr-1"></i>Create New Employee
    </button> --}}
    <input type="submit"  class="btn btn-primary" value="Create New Employee">
</form>
</div>
@stop 