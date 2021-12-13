@extends('adminlte::page')

@section('title', 'Invoice')
@section('plugins.Select2',true)
@section('js')
<script>
$(document).ready(function() {
    $('#role').select2();
});
</script>
@endsection
@section('content')
<x-alert/>
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h4>
          <i class="fas fa-globe"></i> Inventory Management System, FinalYearProject.
          <small class="float-right">Order Date: {{ $order->order_date }}</small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Ram Krishna Mahato</strong><br>
          RK industries<br>
          Gaindakot-2, Nawalpur<br>
          Phone: +977-9845820965<br>
          Email: Ramah_csit2074@lict.edu.np
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Name: {{ $order->name }}</strong><br>
          Shop Name: {{ $order->shopname }}<br>
          Address: {{ $order->address }}<br>
          Phone: {{ $order->phone }}<br>
          Email: {{ $order->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <b>Today Date:</b> {{ date("d/M/Y") }}<br>
        {{-- @php
            $order=DB::table('orders')->select('id')->first();
        @endphp --}}
        <b>Order ID:</b> {{ $order->id }}<br>
        <b>Order status:</b> <span class="badge badge-danger">Pending</span><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>S.N</th>
            <th>Product</th>
            <th>Product Code</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Amount</th>
          </tr>
          </thead>
          <tbody>
            @php
              $sn=1
            @endphp
            @foreach ($order_details as $row )
            <tr>
              <td>{{ $sn++ }}</td>
              <td>{{ $row->product_name }}</td>
              <td>{{ $row->product_code }}</td>
              <td>{{$row->quantity  }}</td>
              <td>{{ $row->rate }}</td>
              <td>{{ $row->rate*$row->quantity }}</td>
            </tr>              
            @endforeach         
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods: <b>{{ strtoupper($order->payment_status)  }}</b></p>
        <p class="lead">Payment Amount: <b>{{ strtoupper($order->pay)  }}</b></p>
        <p class="lead">Amount Due: {{ $order->due }}</p>


      </div>
      <!-- /.col -->
      <div class="col-6">
         <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Subtotal:</th>
              <td>{{ $order->sub_total }}</td>
            </tr>
            <tr>
              <th>Tax (13%)</th>
              <td>{{ $order->vat }}</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>{{ $order->total }}</td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    @if ($order->order_status=='success')
    @else
    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <a href="#"  onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
        <a href="{{ route('admin.orders.confirm',$order->id) }}" class="btn btn-success float-right"><i class="far fa-credit-card"></i>Done</a>
        </button>
      </div>
    </div>
  </div>
    @endif


  <!----payable model is here---->
  {{-- <form action="{{ route('admin.final.invoice') }}" method="post">
    @csrf
    <input type="hidden" name="redirect" value="pos">
    
  <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h4 class="modal-title">Invoice of {{ $customer->name }}<span class="text-danger align-end">Total: {{ Cart::total() }}</span></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <x-alert/>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="payment" class="control-label">Payment</label>                          
                          <select class="form-control" name="payment_status">
                            <option value="handcash">Handcash</option>
                            <option value="cheque">Cheque</option>
                            <option value="card_payment">Card Payment</option>
                            <option value="due">Due</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="pay" class="control-label">Pay</label>
                          <input type="text" name="pay" class="form-control @error('pay') is-invalid           
                          @endif" value="{{ old('pay')??'' }}">
                          @error('pay')
                          <small class="form-text text-danger">{{ $message }}</small>       
                          @enderror
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="due" class="control-label">Due</label>
                          <input type="text" name="due"class="form-control @error('due') is-invalid           
                          @endif" value="{{ old('due')??'' }}">
                          @error('due')
                          <small class="form-text text-danger">{{ $message }}</small>       
                          @enderror
                      </div>
                  </div>
              </div>
          </div>
          <input type="hidden" name="customer_id" value="{{ $customer->id }}">
          <input type="hidden" name="order_date" value="{{ date('d/m/Y') }}">
          <input type="hidden" name="order_status" value="pending">
          <input type="hidden" name="total_products" value="{{ Cart::count() }}">
          <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
          <input type="hidden" name="vat" value="{{ Cart::tax() }}">
          <input type="hidden" name="total" value="{{ Cart::total() }}">


          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </form> --}}
@stop 