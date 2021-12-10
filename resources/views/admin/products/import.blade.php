@extends('adminlte::page')

@section('title', 'Import Products')
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
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Imports Products</h3>
        <div class="card-tools">
            <a class="btn btn-dark btn-sm" href="{{ route('admin.products.export') }}">
              <i class="fas fa-file-download fa-fw mr-1"></i>Download Xlsx</a>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('admin.products.import') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="import_file"> Xlsx File Import</label>
        <input type="file" name="import_file" class="form-control @error('import_file') is-invalid           
        @endif" value="{{ old('import_file')??'' }}">
        @error('import_file')
        <small class="form-text text-danger">{{ $message }}</small>       
        @enderror
    </div>
    <input type="submit"  class="btn btn-primary" value="Upload">
</form>
</div>
<div class="callout callout-info">
    <h5>Info!</h5>

    <p>Follow the steps to import products.</p>
    <p class="text-danger">1: Please download the Xlsx file and clear it.</p>
    <p class="text-danger">2: Now write all products you want to add by listing in correct order.</p>
    <p class="text-danger">3: Now import the same file again that you have edited!</p>
    <p class="text-danger">Thank You!!</p>
  </div>
@stop 