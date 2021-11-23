@extends('adminlte::page')

@section('title', 'Customers')
@section('js')
<script type="text/javascript">
function deleteCustomer(id){
    if(confirm('Are you sure you want to delete this customer?')){
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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Customers</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.customers.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Address</th>
                       <th>Shop name</th>
                       <th>Bank Name</th>
                       <th>Branch</th>
                       <th>Account no.</th>
                       <th>Account Holder</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($customers as $customer )
               <tr>
                   <td>{{ $customer->id }}</td>
                   <td>{{ $customer->name }}</td>
                   <td>{{ $customer->email }}</td> 
                   <td>{{ $customer->phone }}</td>
                   <td>{{ $customer->address }}</td>
                   <td>{{ $customer->shopname }}</td>
                   <td>{{ $customer->bank_name }}</td>
                   <td>{{ $customer->bank_branch }}</td>
                   <td>{{ $customer->account_number }}</td>
                   <td>{{ $customer->account_holder }}</td>
                   <td>
                    <a href="{{ route('admin.customers.edit',$customer->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteCustomer({{ $customer->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $customer->id }}" action="{{ route('admin.customers.destroy',$customer->id) }}">
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