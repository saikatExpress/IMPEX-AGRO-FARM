@extends('layout.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('cow.list') }}">Sell List</a>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>This cow sell from <small>branch {{ session('branch_id') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="" action="{{ route('cow.store') }}" method="post" novalidate>
                    @csrf
                    <span class="section">Cow Sell Info</span>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">গরু<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="cow" id="" class="form-control" required="required">
                                <option value="" selected disabled>Select</option>
                                @foreach ($cows as $key => $cow)
                                    <option value="{{ $cow->id }}">{{ $cow->tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতা<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="buyer_id" id="" class="form-control" required="required">
                                <option value="" selected disabled>Select</option>
                                @foreach ($cows as $key => $cow)
                                    <option value="{{ $cow->id }}">{{ $cow->tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('buyer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">দাম<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="price" required="required" />
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ধরণ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="type" id="" class="form-control">
                                <option value="" selected disabled>select</option>
                                <option value="cow">Cow</option>
                                <option value="bull">Bull</option>
                            </select>
                        </div>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর ট্যাগ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" class='optional' name="tag" data-validate-length-range="5,15" type="text" />
                        </div>
                        @error('tag')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর জাত<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="caste" class='email' required="required" type="text" />
                        </div>
                        @error('caste')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর রঙ <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" class='number' name="color" data-validate-minmax="10" required='required'>
                        </div>
                        @error('color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">বিক্রয় তারিখ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" class='date' type="date" name="sell_date" required='required'>
                        </div>
                        @error('sell_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">বিবরণ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" name='description'></textarea>
                        </div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('asset/vendors/validator/multifield.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('select[name="cow"]').on('change', function(){
                var id = $(this).val();

                if(id != null){
                    $.ajax({
                        url: '/get/cow/info/' + id,
                        type: 'GET',
                        success: function(response){
                            $('select[name="cow"]').val(response.id);  // Assuming 'id' is the field you want to set in the dropdown
                            $('select[name="type"]').val(response.type);
                            $('input[name="tag"]').val(response.tag);
                            $('input[name="caste"]').val(response.caste);
                            $('input[name="color"]').val(response.color);
                            $('textarea[name="description"]').val(response.description);
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>

    <script>
		function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");

			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}
	</script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>
@endsection