@extends('adminlte::page')
@section('title', 'Pay Salary to Employee')

@section('content')
<x-alert/>

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.5em;font-weight:bold">
            Pay Salary to Employee: {{ $employee->name }}
        </h3>
        <div class="card-tools">
            <a class="btn btn-info btn-sm" href="{{ route('admin.salaries.pay') }}">
              <i class="fas fa-arrow-left fa-fw mr-1"></i>Go Back</a>
        </div>
    </div>
<div class="card-body">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Add Payment</h3>
            <hr>
            <form action="{{ route('admin.salaries.payadvance') }}" method="post">
                @csrf
                <input type="hidden" name="emp_id" value="{{ $employee->id }}">
                <div class="form-group">
                    <label for="month">Month</label>
                    <select name="month" class="form-control">
                        <option disabled="" selected="">Choose a month...</option>
                        <option value="January">January</option>
                        <option value="Feburary">Feburary</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" min="{{ now()->format('Y') }}" name="year" id="year" class="form-control @error('year') is-invalid
                    @endif" value="{{ old('year')?? now()->format('Y') }}">
                    @error('year')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="advanced_salary">Advanced Salary Percentage (%)</label>
                    <input type="number" min="1" max="100" name="advanced_salary" id="advanced_salary" class="form-control @error('advanced_salary') is-invalid
                    @endif" value="{{ old('advanced_salary')??'' }}">
                    @error('advanced_salary')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="submit"  class="btn btn-primary" value="Pay Salary">
            </form>
        </div>
        <div class="col-12 col-md-6">
            <h3>Payment History</h3>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th>Date</th>
                    <th>Paid</th>
                    <th>To Pay</th>
                    <th>%</th>
                </thead>
                <tbody>
                    @foreach($salaries as $item)
                    @if($item['to_pay'] == 0)
                            <tr style="background: #f0fdf4">
                        @else
                            <tr>
                        @endif
                        <td>{{ $item['month'] . " " . $item['year'] }}</td>
                        <td>Rs. {{ $item['total_paid'] }}</td>
                        <td>Rs. {{ $item['to_pay'] }}</td>
                        <td>{{ $item['percent'] }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop