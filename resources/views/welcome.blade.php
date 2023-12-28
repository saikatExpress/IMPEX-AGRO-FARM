@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-2">
            <select name="" class="form-control language_switcher" id="">
                <option value="">{{ Config::get('language')[App::getLocale()] }}</option>
                @foreach (Config::get('language') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <option value="{{ $lang }}">
                            <a href="">{{ $language }}</a>
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="row" style="display: inline-block;">
        <div class="tile_count">

            <div class="welcome_text">
                <h2>Welocme To {{ $branchName->branch_name . ' Branch' }}</h2>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/dd-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>{{ __('translate.staffs') }}</h2>
                        <p>{{ numberCountingFormat($staffs) }}</p>
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
                        <p>{{ numberCountingFormat($cows > 0 ? $cows : '0') }}</p>
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
                        <p>{{ numberCountingFormat(0) }}</p>
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
                        <p>{{ numberCountingFormat(0) . ' Ltr' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/expense.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট আয়</h2>
                        <p>{{ numberCountingFormat(0) . ' Tk' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/expense.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>ফার্ম খরচ</h2>
                        <p>{{ numberCountingFormat(0) . ' Tk' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/expense.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>স্থায়ী খরচ</h2>
                        <p>{{ numberCountingFormat($permanetCost) . ' Tk' }}</p>
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
                        <p>{{ numberCountingFormat(0) . ' Ltr' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/beef-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>আজকের গোশত</h2>
                        <p>{{ numberCountingFormat($totalBeef) . ' Kg' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/ezgif-2-a0ef486006-removebg-preview.png') }}" alt="cow image">
                    </div>
                    <div class="dashboard_item">
                        <h2>আজকের আয়</h2>
                        <p>{{ numberCountingFormat(0) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Slim CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

    <script>
        $("body").on('change', '.language_switcher', function(event) {
            event.preventDefault();
            var lang = $(this).val();
            var url = "{{ route('lang.switch', ':lang') }}"
            url = url.replace(':lang', lang);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    if (response.success) {
                        console.log("Language changed successfully", response);
                        window.location.reload();
                    } else {
                        console.log("Language change failed", response.message);
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log("Error changing language", error);
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
