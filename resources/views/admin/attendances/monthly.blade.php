@extends('adminlte::page')
@section('title', 'Monthly Attendance')

@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">
            Monthly Attendance for {{ $month }}, {{ $year }}
            </h3>
           <div class="card-tools">
               <form action="{{ route('admin.attendances.month') }}" method="get" class="form-inline">
                <div class="input-group">
                    <select name="month" class="form-control">
                        @foreach($months as $m)
                        <option value="{{ $m }}" @if($m == $month) selected @endif>{{ $m }}</option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control" min="2015" name="year" value="{{ $year }}">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
                </form>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered table-responsive">
               <thead>
                   <tr>
                       <th>Day</th>
                       @foreach($employees as $emp)
                       <th>{{ $emp->name }}</th>
                       @endforeach
                   </tr>
               </thead>
               <tbody>
                   @foreach($all_data as $data)
                    <tr>
                        <td>{{ $data['day'] }}</td>
                        @foreach($employees as $emp)
                        <td>{{ $data['employees'][$loop->index]['status'] }}</td>
                        @endforeach
                    </tr>
                   @endforeach
            </tbody>
           </table>
       </div>
   </div>
@stop