@extends('adminlte::page')

@section('title', 'Inventory Management System')

@section('content_header')
<div class="container-fluid border border-info rounded mb-2 bg-dark">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-light">POS (Point of Sale)</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item text-danger active">{{ date("d/M/Y") }}</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="btn-group mb-2">
    @foreach ($category as $row )
  <a class="btn btn-sm mr-1 btn-light border border-dark" href="javascript:void(0)" data-filter="all"><strong class="text-uppercase">{{$row->cat_name}}</strong></a>
    @endforeach
</div>
@stop

@section('content')


  <x-alert />
  {{-- @if(session('success'))
    <script>
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        body: '{{ session('success') }}'
      });
    </script>
  @endif --}}

    <div class="row">
        <div class="col-lg-6">
          <form action="{{ route('admin.create.invoice') }}" method="POST">
            @csrf
           <div class="card">
                  <h4 class="text-info mr-2 ml-2 mt-1">Customer
                  <a href="#" class="btn btn-sm btn-info float-sm-right mt-1 mr-1" data-toggle="modal" data-target="#modal-lg">Add New</a>
                  </h4>
                  <select class="form-control" name="id">
                      <option disabled selected>Select Customer</option>
                     @foreach ($customers as $row )
                     <option value="{{ $row->id }}">{{ $row->name }}</option>
                     @endforeach
                  </select>
                <button type="submit" class="btn btn-block btn-outline-success">Create Invoice</button>               
           </div>
          </form>
           <div class="card card-dark card-outline ">
              <div class="card-body box-profile" style="border:2px solid grey ">
                <div class="text-center">
                <ul class="list-group list-group-flush">
                  <table class="table table-bordered">
                    <thead class="bg-dark">
                      <tr>
                        <th class="text-white">Name</th>
                        <th class="text-white">Qty</th>
                        <th class="text-white">Rate</th>
                        <th class="text-white">Amount</th>
                        <th class="text-white">Action</th>
                      </tr>
                    </thead>
                    @php
                      $cart_product=Cart::content()
                    @endphp
                    <tbody>
                      @foreach ($cart_product as $row)
                      <tr>
                        <th>{{ $row->name}}</th>
                        <th>
                          <form action="{{ route('admin.cart.update',$row->rowId) }}" method="POST">
                            @csrf
                            <input type="number" name="qty" value="{{ $row->qty }}" style="width: 40px;">
                            <button type="submit" class="btn btn-sm btn-outline-secondary" style="margin-top:-4px;"><i class="fas fa-check"></i></button>
                          </form>                          
                        </th>
                        <th>{{ $row->price }}</th>
                        <th>{{ $row->price*$row->qty }}</th>
                        <th><a href="{{route('admin.cart.remove',$row->rowId) }}"><i class="fas fa-trash-alt text-danger"></i></a></th>
                      </tr>
                      @endforeach                      
                    </tbody>
                    </table>            
                </ul>
                <div class="bg-dark rounded">
                  <p style="font-size: 19px">Quantity: {{ Cart::count() }}</p>
                  <p style="font-size: 19px">Sub Total: {{ Cart::subtotal() }}</p>
                  <p style="font-size: 19px">Vat 13%: {{ Cart::tax() }}</p>
                  <hr class="bg-white">
                  <p><h1 class="text-danger">Total:</h1><h2>{{ Cart::total() }}</h2></p>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-lg-6">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Products</th>
                        <th>Category</th>
                        <th>Product Code</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($product as $row )
                <tr>
                  <form action="{{ route('admin.cart.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <input type="hidden" name="name" value="{{ $row->product_name }}">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" value="{{ $row->selling_price }}">
                    <input type="hidden" name="weight" value="0">

                    <td>{{ $row->product_name }}</td>
                    <td>{{ $row->cat_name }}</td>
                    <td>{{ $row->product_code }}</td>
                    <td><button type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square mr-1"></button></td>
                  </form>
                </tr>
                @endforeach    
             </tbody>                     
            </table>
        </div>
    </div>
    <!---Customer model are here--->
    <form action="{{ route('admin.customers.store') }}" method="post">
      <input type="hidden" name="redirect" value="pos">
      @csrf
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h4 class="modal-title">Add a New Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <x-alert/>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>                          
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid           
                            @endif" value="{{ old('name')??'' }}">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>       
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone" class="control-label">Phone no.</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid           
                            @endif" value="{{ old('phone')??'' }}">
                            @error('phone')
                            <small class="form-text text-danger">{{ $message }}</small>       
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid           
                            @endif" value="{{ old('address')??'' }}">
                            @error('address')
                            <small class="form-text text-danger">{{ $message }}</small>       
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="email" class="control-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid           
                              @endif" value="{{ old('email')??'' }}">
                              @error('email')
                              <small class="form-text text-danger">{{ $message }}</small>       
                              @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="shopname" class="control-label">Shop Name</label>
                            <input type="text" name="shopname" id="shopname" class="form-control @error('shopname') is-invalid           
                                @endif" value="{{ old('shopname')??'' }}">
                                @error('shopname')
                                <small class="form-text text-danger">{{ $message }}</small>       
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_name" class="control-label">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid           
                              @endif" value="{{ old('bank_name')??'' }}">
                              @error('bank_name')
                              <small class="form-text text-danger">{{ $message }}</small>       
                              @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_branch" class="control-label">Bank Branch</label>
                            <input type="text" name="bank_branch" id="bank_branch" class="form-control @error('bank_branch') is-invalid           
                                @endif" value="{{ old('bank_branch')??'' }}">
                                @error('bank_branch')
                                <small class="form-text text-danger">{{ $message }}</small>       
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account_holder" class="control-label">Account holder Name</label>
                            <input type="text" name="account_holder" id="account_holder" class="form-control @error('account_holder') is-invalid           
                              @endif" value="{{ old('account_holder')??'' }}">
                              @error('account_holder')
                              <small class="form-text text-danger">{{ $message }}</small>       
                              @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account number" class="control-label">Account No.</label>
                            <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid           
                            @endif" value="{{ old('account_number')??'' }}">
                            @error('account_number')
                            <small class="form-text text-danger">{{ $message }}</small>       
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add new customer</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>
      <!-- /.modal -->
@stop