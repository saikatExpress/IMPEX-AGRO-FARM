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
                <a class="btn btn-sm btn-primary" href="{{ route('category.list') }}">Pregnancy List</a>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>Pregnancy Save for <small style="color:#000; font-weight:bold;"> Branch : {{ session('branch_id') }} </small></h2>
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

                <form class="" action="{{ route('pregnancy.store') }}" method="post" novalidate>
                    @csrf
                    <span class="section">Pregnancy Info</span>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Animal Tag<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="cow_id" class="form-control" id="">
                                <option value="" disabled selected>Select</option>
                                @foreach ($cows as $key => $cow)
                                    <option value="{{ $cow->id }}">{{ $cow->tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cow_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Pregnancy Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="pregnancy_type" class="form-control" id="">
                                <option value="" disabled selected>Select</option>
                                <option value="automatic">Automatic</option>
                                <option value="semen">By Collected Semen</option>
                            </select>
                        </div>
                        @error('pregnancy_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Semen Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="semen_id" class="form-control" id="">
                                <option value="" disabled selected>Select</option>
                                <option value="automatic">Brahman</option>
                                <option value="semen">Friesian</option>
                                <option value="semen">Holstaien</option>
                            </select>
                        </div>
                        @error('semen_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Semen Push Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="push_date" type="date" required="required" />
                        </div>
                        @error('push_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Pregnancy Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="start_date" type="date" required="required" />
                        </div>
                        @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Semen Cost<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="semen_cost" type="date" required="required" />
                        </div>
                        @error('semen_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Other Cost<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="other_cost" type="date" required="required" />
                        </div>
                        @error('other_cost')
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