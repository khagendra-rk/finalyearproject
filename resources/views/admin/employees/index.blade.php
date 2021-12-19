@extends('adminlte::page')

@section('title', 'Employees')
@section('js')
<script type="text/javascript">
function deleteEmployee(id){
    if(confirm('Are you sure you want to delete this employee?')){
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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Employees</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.employees.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Address</th>
                       <th>Salary</th>
                       <th>Experience</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($employees as $employee )
               <tr>
                   <td>{{ $employee->id }}</td>
                   <td>{{ $employee->name }}</td>
                   <td>{{ $employee->email }}</td> 
                   <td>{{ $employee->phone }}</td>
                   <td>{{ $employee->address }}</td>
                   <td>{{ $employee->salary }}</td>
                   <td>{{ $employee->experience }}</td>
                   <td>
                    <a href="{{ route('admin.employees.edit',$employee->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteEmployee({{ $employee->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $employee->id }}" action="{{ route('admin.employees.destroy',$employee->id) }}">
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