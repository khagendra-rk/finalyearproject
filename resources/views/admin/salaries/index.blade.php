@extends('adminlte::page')

@section('title', 'All Advanced Salaries')
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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Advanced Salaries</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.salaries.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Employee Name</th>
                       <th>Payment Date</th>
                       <th>Advanced Salary</th>
                       <th>Salary</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($salaries as $salary )
               <tr>
                   <td>{{ $salary->employee->name }}</td>
                   <td>{{ $salary->month }}, {{ $salary->year }}</td>
                   <td>Rs. {{ $salary->advanced_salary }}</td>
                   <td>Rs. {{ $salary->employee->salary }}</td>
                   <td>
                    <a href="{{ route('admin.salaries.edit',$salary->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteSalary({{ $salary->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $salary->id }}" action="{{ route('admin.salaries.destroy',$salary->id) }}">
                     @csrf
                     @method('DELETE')
                 </form>
                </td>
               </tr>
               @endforeach    
            </tbody>                     
           </table>
       </div>
   </div>
@stop