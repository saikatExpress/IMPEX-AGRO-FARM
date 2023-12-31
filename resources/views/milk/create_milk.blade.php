@extends('layout.master')
@section('content')

    <div style="display: none;" class="successMsg">
        <div>
            <span id="msgCross"> &times;</span>
            <h2>Data Saved</h2>
        </div>
    </div>

    <div class="container mt-5">
        <h2 style="color: #000; font-weight:bold;" class="mb-4">Daily Milk Store</h2>

        <h2 id="demo" style="display: none; color:darkblue; font-weight:bold;">The Time is now</h2>

        <form  method="post">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="date" class="form-control" name="milk_date" name="date">
                        <span style="color: red; font-weight:bold;" id="errorMsg"></span>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Daily Milk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cows as $key => $cow)
                        <tr>
                            <td>{{ $cow->tag }}</td>

                            <td>
                                <input type="number" class="form-control quantity" data-cow-id="{{ $cow->id }}" name="quantity" placeholder="Enter ltr">
                            </td>

                            <td>
                                <button type="button" data-id="{{ $cow->id }}" class="btn btn-primary">Add</button>
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
            $('.btn-primary').click(function(){
                var id = $(this).data('id');
                var date = $('input[name="milk_date"]').val();
                var quantity = $(this).closest('tr').find('.quantity').val();

                if(id > 0){
                    $.ajax({
                        url: '/cow/milk/store/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                            date: date,
                            quantity: quantity,
                        },
                        success: function(response){
                            if(response.message){
                                $('.successMsg').find('h2').text(response.message);
                                $('.successMsg').show();
                            }
                        },
                        error: function(error){
                            console.log(error);
                            // Handle error here
                            if (error.responseJSON && error.responseJSON.message) {
                                // Display error message in the view
                                // $(this).closest('tr').find('.error-message').text(error.responseJSON.message).show();
                                $('#errorMsg').text(error.responseJSON.message);
                            }
                        }
                    });
                }else{
                    alert('Your Selectd button have no id!');
                }
            });
        });
    </script>
@endsection
