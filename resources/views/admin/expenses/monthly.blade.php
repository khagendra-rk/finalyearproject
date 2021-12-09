@extends('adminlte::page')

@section('title', 'Monthly Expenses')
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
<div class="d-flex justify-content-center">
    <a href="{{ route('admin.expenses.january') }}" class="btn btn-sm btn-light border border-info .px-3">January</a>
    <a href="{{ route('admin.expenses.february') }}" class="btn btn-sm btn-light border border-info">February</a>
    <a href="{{ route('admin.expenses.march') }}" class="btn btn-sm btn-light border border-info">March</a>
    <a href="{{ route('admin.expenses.april') }}" class="btn btn-sm btn-light border border-info">April</a>
    <a href="{{ route('admin.expenses.may') }}" class="btn btn-sm btn-light border border-info">May</a>
    <a href="{{ route('admin.expenses.june') }}" class="btn btn-sm btn-light border border-info">June</a>
    <a href="{{ route('admin.expenses.july') }}" class="btn btn-sm btn-light border border-info">July</a>
    <a href="{{ route('admin.expenses.august') }}" class="btn btn-sm btn-light border border-info">August</a>
    <a href="{{ route('admin.expenses.september') }}" class="btn btn-sm btn-light border border-info">September</a>
    <a href="{{ route('admin.expenses.october') }}" class="btn btn-sm btn-light border border-info">October</a>
    <a href="{{ route('admin.expenses.november') }}" class="btn btn-sm btn-light border border-info">November</a>
    <a href="{{ route('admin.expenses.december') }}" class="btn btn-sm btn-light border border-info">December</a>
</div>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title text-danger" style="font-size: 1.5em;font-weight:bold">Monthly Expenses</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.expenses.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>Details</th>
                       <th>Amount</th>
                       <th>Date</th>
                       <th>Month</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($expense as $row )
               <tr>
                   <td>{{ $row->details }}</td>
                   <td>{{ $row->amount }}</td> 
                   <td>{{ $row->date }}</td> 
                   <td>{{ $row->month }}</td>
               </tr>
               @endforeach    
            </tbody>                     
           </table>
       <h3 style="color:black;font-size:30px" align="center">Total :{{ $sum }}</h3>
       </div>
   </div>
@stop