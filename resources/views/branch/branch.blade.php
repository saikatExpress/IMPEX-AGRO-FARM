<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impex Agro Farm | Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="{{ asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
</head>

<body style="background-color: #595959">
    <div class="container">
        <div class="branch_container">
            <h2 class="text-align">Choose A Branch</h2>
            <div class="branch_body">
                @foreach ($branches as $key => $branch)
                    <div style="width: 80%;" class="card branch-card">
                        <div class="d-flex">
                            <div class="branch_image">
                                <img src="{{ asset('custom/logos/Untitled-removebg-preview.png') }}" alt="">
                            </div>
                            <div class="branch_title">
                                <a href="{{ route('select.branch', ['branch_id' => $branch->id]) }}">
                                    <h4 class="card-title">
                                        {{ $branch->branch_name }}
                                    </h4>
                                    <h5 class="card-title_h5">
                                        {{ $branch->branch_address }}
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="branch_footer">
                    <a href="{{ url('logout') }}" class="btn btn-danger btn-sm">
                        Sign Out
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
