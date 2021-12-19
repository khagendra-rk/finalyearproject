@extends('adminlte::page')

@section('title', 'yearly Expenses')
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
           <h3 class="card-title text-danger" style="font-size: 1.5em;font-weight:bold">{{ date("Y") }} All Expenses</h3>
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
                       <th>year</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($expense as $row )
               <tr>
                   <td>{{ $row->details }}</td>
                   <td>{{ $row->amount }}</td> 
                   <td>{{ $row->year }}</td>
               </tr>
               @endforeach    
            </tbody>                     
           </table>
       <h3 style="color:black;font-size:30px" align="center">Total :{{ $sum }}</h3>
       </div>
   </div>
@stop