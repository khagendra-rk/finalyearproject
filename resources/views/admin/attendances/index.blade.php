@extends('adminlte::page')

@section('title', 'All Attendances')
@section('js')
<script type="text/javascript">
function deleteAttendance(edit_date){
    if(confirm('Are you sure you want to delete this Attendance?')){
        document.querySelector('#delete-'+edit_date).submit();
    }
    return;
}
</script>
@endsection
@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Attendance</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.attendances.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>S.N</th>
                       <th>Edit Date</th>
                       <th>Edit</th>
                   </tr>
               </thead>
               <tbody>
                   @php
                       $count=1
                   @endphp
               @foreach ($attendances as $attendance)
               <tr>
                   <td>{{ $count++}}</td>
                   <td>{{ $attendance->edit_date }}</td>
                   <td>
                    <a href="{{ route('admin.attendance.edit', ['date' => $attendance->edit_date]) }}">View & Edit</a>
                   </td>
               </tr>
               @endforeach
            </tbody>
           </table>
       </div>
   </div>
@stop