@extends('adminlte::page')

@section('title', 'Inventory Management System')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Sales</span>
            <span class="info-box-number">760</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
  
              <div class="info-box-content">
               <span class="info-box-text">Users</span>
                  <span class="info-box-number">3</span>
               </div>
              <!-- /.info-box-content -->
           </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

             <div class="info-box-content">
            <span class="info-box-text">Employees</span>
            <span class="info-box-number">10</span>
        </div>
            <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-rupee-sign"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Today Expense</span>
          <span class="info-box-number">500</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    
  </div>
@stop
