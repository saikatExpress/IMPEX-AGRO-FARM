$(document).ready(function(){
    $('#shedId').on('click', function(){
        var shedId = $(this).val();
        $.ajax({
            url: '/get/shed/cows/' + shedId,
            type: 'GET',
            success: function(response){
                console.log(response);
                var cows = response;
                $('#cowId').empty();
                $('#cowId').append('<option value="">Select</option>');
                $.each(cows, function(index, cow){
                    $('#cowId').append('<option value="' + cow.id + '">' + cow.tag + '</option>');
                });
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
