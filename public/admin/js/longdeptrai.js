$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete-btn').click(function (e) {
        e.preventDefault();
        let id = $(this).attr("delete-id");
        let route = $(this).attr("delete-route");

        swal.fire({
            title: "Bạn chắc chứ",
            text: "Click delete, bạn sẽ xóa dữ liệu?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Chắc chắn!',
            cancelButtonText: 'Hủy!',
        })
        .then((result) => {
            if (result.isConfirmed) {
                let url = 'admin/' + route + '/' + id

                let data = {
                    "_token": $('input[name=_token]').val(),
                    "id": id
                }
                console.log(data);

                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: "data",
                    success: function (response) {
                        // swal.fire(, {
                        //     icon: "success",
                        // })
                        Swal.fire(
                            response.title,
                            response.text,
                            response.status
                        )
                        .then((result) => {
                            location.reload();
                        });
                    },
                });
            }
        });
    });
});
