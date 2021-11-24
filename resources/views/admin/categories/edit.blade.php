@extends('adminlte::page')

@section('title', 'Edit Category')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Edit Category:{{ $category->cat_name }}</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.categories.index') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.categories.update',$category->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="cat_name"> Category Name</label>
        <input type="text" name="cat_name" id="cat_name" class="form-control @error('cat_name') is-invalid           
        @endif" value="{{ old('cat_name')??$category->cat_name}}">
        @error('cat_name')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
   
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus fa-fw mr-1"></i>Create New Employee
    </button> --}}
    <input type="submit"  class="btn btn-primary" value="Update category">
</form>
</div>
@stop 