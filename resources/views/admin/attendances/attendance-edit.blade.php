@extends('adminlte::page')
@section('title', 'Update Attendance')
@section('content')

<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Update Attendance: {{ $date }}</h3>
        <div class="card-tools">
        <a class="btn btn-success btn-sm" href="{{ route('admin.attendances.index') }}">
            <i class="fas fa-eye fa-fw mr-1"></i>All Attendance</a>
    </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.attendance.update', ['date' => $date]) }}" method="POST">
            @csrf
        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $item )
                <tr>
                    <td>{{ $item->employee->name }}</td>
                    <td>{{ $item->employee->phone }}</td>
                    <td>

                    <input type="hidden" name="record[{{  $loop->index }}][id]" value="{{ $item->id }}">
                    <select name="record[{{  $loop->index }}][status]">
                        <option value="Present">Present</option>
                        <option value="Absent" @if($item->status == 'Absent') selected @endif>Absent</option>
                    </select>
                </td>
                </tr>
                @endforeach  
                </tbody>                     
                </table>
                <button type="submit" class="btn btn-info">Update Attendance</button>
            </form>  
    </div>
</div>
@stop