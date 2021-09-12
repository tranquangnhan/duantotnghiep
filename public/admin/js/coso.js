$(document).ready(function() {
    $('.them').click(function() {
        var name = $('.name').val();
        var city = $('.city').val();
        var province = $('.province').val();
        var wards = $('.wards').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url("/quantri/add-dellivery")}}',
            method: 'POST',
            data: { name: name, city: city, province: province, wards: wards, _token: _token },
            complete: function() {
                // Handle the complete event
                window.location.replace("quantri/coso");

                alert('thêm cơ sở thành công');
            }

        });
    });

});



$('.choose').on('change', function() {
    var action = $(this).attr('id');
    var ma_id = $(this).val();
    var _token = $('input[name="_token"]').val();

    var result = '';

    if (action == 'city') {
        result = 'province';
    } else {
        result = 'wards';
    }
    $.ajax({

        url: '{{url("/quantri/select-dellivery")}}',
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        data: { action: action, ma_id: ma_id, _token: _token },
        success: function(data) {
            $('#' + result).html(data);
        }
    });
});