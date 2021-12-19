@extends('adminlte::page')

@section('title', 'Expenses')
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
       <div class="card-header">
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Expenses</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.expenses.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Details</th>
                       <th>Amount</th>
                       <th>Month</th>
                       <th>Date</th>
                       <th>Year</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($expenses as $expense )
               <tr>
                   <td>{{ $expense->id }}</td>
                   <td>{{ $expense->details }}</td>
                   <td>{{ $expense->amount }}</td> 
                   <td>{{ $expense->month }}</td>
                   <td>{{ $expense->date }}</td>
                   <td>{{ $expense->year }}</td>
                   <td>
                    <a href="{{ route('admin.expenses.edit',$expense->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteExpense({{ $expense->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $expense->id }}" action="{{ route('admin.expenses.destroy',$expense->id) }}">
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