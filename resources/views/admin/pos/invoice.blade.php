@extends('adminlte::page')

@section('title', 'invoice')
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
          <small class="float-right">Date: {{ date('d/M/Y') }}</small>
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
          <strong>Name: {{ $customer->name }}</strong><br>
          Shop Name: {{ $customer->shopname }}<br>
          Address: {{ $customer->address }}<br>
          Phone: {{ $customer->phone }}<br>
          Email: {{ $customer->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <b>Order Date:</b> {{ date("jS \ F Y") }}<br>
        {{-- @php
            $order=DB::table('orders')->select('id')->first();
        @endphp --}}
        <b>Order ID:</b> {{-- {{ $order++ }} --}}4F3S8J<br>
        <b>Order status:</b> <span class="badge badge-danger">Pending</span><br>
        <b>Bank Name:</b> {{ $customer->bank_name }}<br>
        <b>Account No. :</b> {{ $customer->account_number }}
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
            <th>Qty</th>
            <th>Rate</th>
            <th>Amount</th>
          </tr>
          </thead>
          <tbody>
            @php
              $sn=1
            @endphp
            @foreach ($contents as $content )
            <tr>
              <td>{{ $sn++ }}</td>
              <td>{{ $content->name }}</td>
              <td>{{$content->qty  }}</td>
              <td>{{ $content->price }}</td>
              <td>{{ $content->price*$content->qty }}</td>
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
        {{-- <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> --}}
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead"></p>

        <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Subtotal:</th>
              <td>{{ Cart::subtotal() }}</td>
            </tr>
            <tr>
              <th>Tax (13%)</th>
              <td>{{ Cart::tax() }}</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>{{ Cart::total() }}</td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <a href="#"  onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-lg"><i class="far fa-credit-card"></i> Submit
          Payment
        </button>
      </div>
    </div>
  </div>


  <!----payable model is here---->
  <form action="{{ route('admin.final.invoice') }}" method="post">
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
  </form>
@stop 