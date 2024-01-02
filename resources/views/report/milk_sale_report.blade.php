@extends('layout.master')
@section('content')
    <div class="row">
        <form style="width: 100%" action="{{ route('show.milk_sale_report') }}" method="post">
            @csrf
            <div class="d-flex">
                <div class="col-4">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date" class="form-control">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="">End Date</label>
                    <input type="date" name="end_date" class="form-control">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="">Search</label>
                    <input type="submit" value="Search" class="form-control btn btn-sm btn-primary">
                </div>
            </div>
        </form>

        <!-- Display the fetched data -->
        @if(isset($milkSales))
            <div style="width:100%;background-color: #fff;" class="mt-4">
                <div class="report_block">
                    <img src="{{ asset('custom/logos/logo.png') }}" alt="no images">
                    <h2 style="text-transform: uppercase;">impex agro farm</h2>
                    <h4>Branch  {{ session('branch_id') }}</h4>
                    <h4>Milk Sale Report</h4>
                    <h4> from {{ $startDate }} to {{ $endDate }}</h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S\L</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Qauntity</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($milkSales as $sale)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ dateTimeFormat($sale->sale_date) }}</td>
                                <td>{{ ucfirst($sale->name) }}</td>
                                <td>{{ $sale->phone_number }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->price }}</td>
                                <td>{{ $sale->payment }}</td>
                                <td>{{ $sale->due }}</td>
                            </tr>
                            @php
                                $sl++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

                <!-- Print button -->
                <button onclick="window.print()" class="btn btn-sm btn-secondary">Print Report</button>
            </div>
        @endif
    </div>
@endsection