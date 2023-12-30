@extends('layout.master')

@section('content')
    <div class="container mt-5">
        <h2 style="color: #000; font-weight:bold;" class="mb-4">Salary Update</h2>

        <form action="{{ route('store.salary') }}" method="post">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Image</th>
                        <th>Basic Salary</th>
                        <th>Month Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $key => $staff)
                    <tr>
                        <td>{{ $staff->name }}</td>
                        <td>
                            <img style="width: 50px;height:50px;" src="{{ asset('images/staffs/' . $staff->staff_image) }}" alt="">
                        </td>
                        <td>
                            <input class="basic" data-basic-salary="{{ $staff->salary }}" style="border:none; background:transparent;" type="text" value="{{ $staff->salary }}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control salary" data-staff-id="{{ $staff->id }}" name="salaries[{{ $staff->id }}]" placeholder="Enter salary">
                            <span class="error-message" style="color: red; display: none;">You've entered a salary over the basic amount.</span>
                        </td>
                        <td>
                            <button type="button" data-id="{{ $staff->id }}" class="btn btn-primary">Add</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.salary').on('input', function(){
                let enteredSalary = parseFloat($(this).val());
                let basicSalary = parseFloat($(this).closest('tr').find('.basic').data('basic-salary'));

                if (enteredSalary > basicSalary) {
                    $(this).next('.error-message').show();
                } else {
                    $(this).next('.error-message').hide();
                }
            });

            $('.btn-primary').click(function(){
                var id = $(this).data('id');
                alert(id);
            });
        });
    </script>

@endsection
