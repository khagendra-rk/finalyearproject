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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Pay Salaries: <span class="text-danger">{{ date("F Y") }}</span></h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.salaries.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>Employee Name</th>
                       <th>Salary</th>
                       <th>Month</th>
                       <th>Advanced Salary</th>                       
                       <th>Pay</th>
                   </tr>
               </thead>
               {{-- @php
               $month=date("F",strtotime('-1 month'));
            $salaries = DB::table('salaries')
            ->join('employees', 'salaries.emp_id', 'employees.id')
            ->select('salaries.*', 'employees.name', 'employees.salary')
            ->where('month','$month')
            ->get(); --}}
               {{-- @endphp --}}
               <tbody>
               @foreach ($employee as $row )
               <tr>
                   <td>{{ $row->name }}</td>
                   <td>{{ $row->salary }}</td>
                   <td>{{date("F",strtotime('-1 months'))}}</td>
                   {{-- <td>{{ $row->advanced_salary }}</td> --}}
                   <td><a href="{{ route('admin.salaries.pay',$row->id) }}">Pay Now</a></td>
               </tr>
               @endforeach    
            </tbody>                     
           </table>
       </div>
   </div>
@stop