@extends('layout.master')
@section('content')
    <div class="row" style="display: inline-block;">
        <div class="tile_count">

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/dd-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Total Staff</h2>
                        <p>{{ numberCountingFormat(7) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/images/cow-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Total Cow</h2>
                        <p>{{ numberCountingFormat(20) }}</p>
                    </div>
                </div>
            </div>



            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/istockphoto-165186661-612x612-removebg-preview.png') }}"
                            alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Total Calf</h2>
                        <p>{{ numberCountingFormat(7) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/ezgif-2-e34d9fb6d1-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Total Sold Milk</h2>
                        <p>{{ numberCountingFormat(1023) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/expense.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Total Expense</h2>
                        <p>{{ numberCountingFormat(7000) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/ezgif-2-e34d9fb6d1-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Today Sold Milk</h2>
                        <p>{{ numberCountingFormat(120) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/beef-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Today Beef</h2>
                        <p>{{ numberCountingFormat(70) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/ezgif-2-a0ef486006-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>Today Collected</h2>
                        <p>{{ numberCountingFormat(80) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
