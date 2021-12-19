@extends('adminlte::page')

@section('title', 'All Products')
@section('js')
<script type="text/javascript">
function deleteProduct(id){
    if(confirm('Are you sure you want to delete this  Product?')){
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
           <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">All Products</h3>
           <div class="card-tools">
               <a class="btn btn-info btn-sm" href="{{ route('admin.products.create') }}">
                <i class="fas fa-user-plus fa-fw mr-1"></i>Add New</a>
           </div>
       </div>
       <div class="card-body">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Product Name</th>
                       <th>Code</th>
                       <th>Stock</th>
                       <th>Category</th>
                       <th>Supplier</th>
                       <th>Buying Date</th>
                       <th>Expire Date</th>
                       <th>Buy Price</th>
                       <th>Sell Price</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               <tbody>
               @foreach ($products as $product )
               <tr>
                   <td>{{ $product->product_name}}</td>
                   <td>{{ $product->product_code}}</td>
                   <td>{{ $product->stocks_sum_quantity ?? 0 }}</td>
                   <td>{{ $product->category->cat_name}}</td>
                   <td>{{ $product->supplier->name}}</td>
                   <td>{{ $product->buy_date}}</td>
                   <td>{{ $product->expire_date}}</td>
                   <td>{{ $product->buying_price}}</td>
                   <td>{{ $product->selling_price}}</td>
                   <td>
                    <a href="{{ route('admin.products.edit',$product->id) }}">Edit</a>
                </td>
                <td>
                 <a href="#" onclick="deleteProduct({{ $product->id  }})">Delete</a>
                 <form  style="display:none" method="POST" id="delete-{{ $product->id }}" action="{{ route('admin.products.destroy',$product->id) }}">
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