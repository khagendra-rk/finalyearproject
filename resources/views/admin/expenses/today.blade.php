@extends('adminlte::page')

@section('title', 'Today Expenses')
@section('js')
<script type="text/javascript">
function deleteExpense(id){
    if(confirm('Are you sure you want to delete this Expense?')){
        document.querySelector('#delete-'+id).submit();
    }
    return;
}
</script>
@endsection
@section('content')
<x-alert/>
   <div class="card">
       <h3 style="color:black;font-size:30px" align="center">Total :{{ $sum }}</h3>
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">Today Expenses</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.expenses.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Details</th>
                       <th>Amount</th>
                       <th>Month</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($today as $row )
               <tr>
                   <td>{{ $row->details }}</td>
                   <td>{{ $row->amount }}</td> 
                   <td>{{ $row->month }}</td>
                   <td>
                    <a href="{{ route('admin.expenses.edit',$row->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteExpense({{ $row->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $row->id }}" action="{{ route('admin.expenses.destroy',$row->id) }}">
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