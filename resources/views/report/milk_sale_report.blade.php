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
    </div>
@endsection