@extends('adminlte::page')

@section('title', 'Update Attendance')
@section('content')
<x-alert/>
<div class="card">
<h2 class="font-italic font-weight-bold text-info" align="center">Today: {{ date("d/M/Y") }}</h2>
</div>

   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">View Attendance</h3>
           <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('admin.attendances.index') }}">
              <i class="fas fa-eye fa-fw mr-1"></i>All Attendance</a>
        </div>
       </div>
       <div class="card-body">
           <table class="table">
            @php
            $employees=DB::table('employees')->get();
            @endphp
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>Phone</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($employees as $employee )
               <tr>
                   <td>{{ $employee->name }}</td>
                   <td>{{ $employee->phone }}</td>
                   <td>
                    <input type="hidden" name="id[]" value="{{ $employee->id }}">
                    <input type="hidden" name="attendance_date" value="{{ date("d/m/y") }}">
                    <input type="hidden" name="attendance_month" value="{{ date("M") }}">
                    <input type="hidden" name="attendance_year" value="{{ date("Y") }}">
                    <input type="radio" class="mr-1" name="status[{{ $employee->id }}]" value="Present" disabled @if($employee->attendance=='Present'){echo "checked"} @if($employee->attendance=='Present'){echo "checked"} @endif>Present&nbsp;&nbsp;
                    <input type="radio" class="mr-1" name="status[{{ $employee->id }}]" value="Absent" disabled @if($employee->attendance=='Absent'){echo "checked"}>Absent                    
                </td>
               </tr>
               @endforeach  
            </tbody>                     
           </table>
       </div>
   </div>
@stop