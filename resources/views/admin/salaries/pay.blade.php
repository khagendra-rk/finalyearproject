@extends('adminlte::page')

@section('title', 'Pay Salaries')
@section('js')
<script type="text/javascript">
function deleteSalary(id){
    if(confirm('Are you sure you want to delete this  Advanced Salary?')){
        document.querySelector('#delete-'+id).submit();
    }
    return;
}
</script>
@endsection
@section('content')
<x-alert/>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">
                Pay Salary
           </h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.salaries.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>SN</th>
                       <th>Employee Name</th>
                       <th>Salary</th>
                       <th></th>
                   </tr>
               </thead>
               <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>Rs. {{ $employee->salary }}</td>
                    <td>
                        <a href="{{ route('admin.salaries.employee.pay', $employee->id) }}">
                            Pay Salary
                        </a>
                    </td>
                </tr>
                @endforeach
               </tbody>
           </table>
       </div>
   </div>
@stop