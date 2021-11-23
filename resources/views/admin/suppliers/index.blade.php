@extends('adminlte::page')

@section('title', 'Suppliers')
@section('js')
<script type="text/javascript">
function deleteSupplier(id){
    if(confirm('Are you sure you want to delete this supplier?')){
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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Suppliers</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.suppliers.create') }}">
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
                       <th>Type</th>
                       <th>Bank Name</th>
                       <th>Branch</th>
                       <th>Account no.</th>
                       <th>Account Holder</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($suppliers as $supplier )
               <tr>
                   <td>{{ $supplier->id }}</td>
                   <td>{{ $supplier->name }}</td>
                   <td>{{ $supplier->email }}</td> 
                   <td>{{ $supplier->phone }}</td>
                   <td>{{ $supplier->address }}</td>
                   <td>{{ $supplier->shopname }}</td>
                   <td>{{ $supplier->type }}</td>
                   <td>{{ $supplier->bank_name }}</td>
                   <td>{{ $supplier->bank_branch }}</td>
                   <td>{{ $supplier->account_number }}</td>
                   <td>{{ $supplier->account_holder }}</td>
                   <td>
                    <a href="{{ route('admin.suppliers.edit',$supplier->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteSupplier({{ $supplier->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $supplier->id }}" action="{{ route('admin.suppliers.destroy',$supplier->id) }}">
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