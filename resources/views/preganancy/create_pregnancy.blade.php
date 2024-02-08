@extends('layout.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

            <div class="container mt-5">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Animal Information</h5>
                  </div>
                  <div class="card-body">
                    
                      <div class="form-group">
                        <label class="col-form-label   label-align">Stall Selection<span class="required">*</span></label>
                        
                        <select class="form-control" id="itemSelection">
                          <option selected disabled>Select</option>
                          <option>Option 1</option>
                          <option>Option 2</option>
                        </select>
                      </div>

                      <label class="col-form-label label-align">Animal ID <span class="required">*</span></label>


    <form id="searchForm" method="GET" action="{{ route('search.zones') }}">
        <select class="form-control" name="search" id="searchSelect" style="border-color:#0f0097; border-radius:8px; height: 38px;" onchange="this.form.submit()">
            <option >select...</option>
            @foreach($read as $data)
            <option value="{{$data->tag}}">{{$data->tag}}</option>
            @endforeach
        </select>
    </form>

    <div>
        <h1>  </h1>
    </div>

    <div class="row" id="cowDetailsSection">
        <div class="col-md-6">
          <div class="card-img-top">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/Cow_female_black_white.jpg" class="img-fluid" alt="Cow Picture">
          </div>
        </div>
        <div class="col-md-6" id="cowDetails">
            <div class="card-footer">
                <h5 class="card-title">Cow Details</h5>
                <ul class="list-unstyled">
                    @foreach($reads as $data)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Caste:</strong> <span style=>{{$data->caste}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Color:</strong> {{$data->color}}
                        </li>
                        <li class="list-group-item">
                            <strong>Weight:</strong> {{$data->weight}}
                        </li>
                        <li class="list-group-item">
                            <strong>Buy-Date:</strong> {{$data->buy_date}}
                        </li>
                        <li class="list-group-item">
                            <strong>Buy-Date Age:</strong> {{$data->age}}
                        </li>
                    </ul>
                    
                    @endforeach
                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>



  <div class="row" style="margin-left:5px; width:1000px;">
    <div class="col-md-12">
        <div class="table-responsive">
            <h5 class="card-title">Pregnancy Records</h5>
            <table class="table table-striped table-bordered">
                <thead id="haed">
                    <tr>
                        <th>Pregnancy Type</th>
                        
                        <th>Semen Push Date</th>
                        <th>Pregnancy Start Date</th>
                        <th>Semen Cost</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($readpreg as $data)
                    <tr>
                        <td style="font-size: 15px">{{ $data->pregnancy_type }}</td>
                        <td style="font-size: 15px">{{ $data->push_date }}</td>
                        <td style="font-size: 15px">{{ $data->start_date }}</td>
                        <td style="font-size: 15px">{{ $data->semen_cost }}</td>
                        
                        
                        
                        
                
                        <td id="actios_btn">
                            {{-- <a href="{{route('go.editcustomer', $data->id)}}"> <button>Edit</button></a>  --}}
                                        
                            <form method="POST" >
                                @method('DELETE')
                                @csrf
                                <input type="text" name="passing_id" value="{{$data->id}}" hidden>
                                <button class="btn btn-primary">Edit</button>
                                 <button class="btn btn-danger">Delete</button>

                            </form> 
                        </td>
                    </tr>
                    @endforeach
                   
                    <!-- Add more rows as needed -->
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th colspan="8">Total</th>
                        <td>$50.00</td> <!-- Adjust the total amount based on your data -->
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
</div>











  <form class="" action="{{ route('pregnancy.store') }}" method="post" novalidate>
    @csrf
    <div class="card-header">
        <h5 class="card-title">Pregnancy Info</h5>
      </div>

    <div class="field item form-group">
        <label class="col-form-label col-md-3 col-sm-3  label-align">Animal Tag<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6">
            <select class="form-control" id="itemSelection" name="cow_id">
                <option >select...</option>
                @foreach($read as $data)
                <option  value="{{$data->tag}}">{{$data->tag}}</option>
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
            <select name="pregnancy_type" class="form-control" id="" name="pregnancy_type">
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
            <input class="form-control" name="semen_cost" type="number" required="required" />
        </div>
        @error('semen_cost')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="field item form-group">
        <label class="col-form-label col-md-3 col-sm-3  label-align">Other Cost<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" name="other_cost" type="number" required="required" />
        </div>
        @error('other_cost')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="field item form-group">
        <label class="col-form-label col-md-3 col-sm-3  label-align">Note<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6">
            <textarea name="" class="form-control" id="" cols="10" rows="5"></textarea>
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
    


    
    
</body>
</html>

@endsection