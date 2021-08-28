$(document).ready(function() {
    $('#table_product').DataTable(
        {
            "language": {
                "search":"Tìm Kiếm:",
                "sProcessing": "Đang xử lý...",
                "lengthMenu": "Xem _MENU_ mục",
                "zeroRecords": "Không có dữ liệu",
                "info": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục.",
                "paginate": {
                    "first":      "Trang đầu",
                    "last":       "Trang cuối",
                    "next":       "Trang Sau",
                    "previous":   "Trang Trước"
                },
            }
        }
    );
});

function submitForm() {

    let message = document.getElementById("ErrorColor");
    let valColor = $('#color').val();
    if (valColor == "") {
        message.innerHTML = "";
        return true
    } else {

        let arr = valColor.split(",")
        console.log(arr.length);
        for (let i = 0; i < arr.length; i++) {
            if (arr[i].charAt(0) != '#') { message.innerHTML = "Định dạng hợp lệ là #000, #fff, ..."; return false; } else { message.innerHTML = ""; }
            if (arr[i].slice(1).length != 3) { message.innerHTML = "Định dạng hợp lệ là #000, #fff, ..."; return false; } else { message.innerHTML = ""; }
        }

    }



}

function checkDelete(link) {
    Swal.fire({
        title: 'Xóa?',
        text: "Bạn chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa!',
        cancelButtonText: 'hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
    })
}

function checkDeleteCate(link, IDCATE, style, slug) {
    Swal.fire({
        title: 'Xóa?',
        text: "Bạn chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa!',
        cancelButtonText: 'Hủy',
    }).then(async(result) => {
        if (result.isConfirmed) {
            let checkStatus = new FormData();

            checkStatus.append('IDcate', IDCATE);
            checkStatus.append('style', style);
            checkStatus.append('slug', slug);
            checkStatus.append('Action', 'CheckChildCate');
            await $.ajax({
                type: 'POST',
                url: 'controllers/ajax/order.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: checkStatus,
                success: async function(response) {
                    console.log(response);
                    if (response[0] === 0) {
                        await Swal.fire({
                            timer: 2000,
                            type: 'success',
                            title: 'Yeah',
                            showConfirmButton: false,
                            showCancelButton: false,
                            icon: "success"
                        });
                        window.location.href = link

                    } else if (response[0] === 1) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops.',
                            text: 'Danh mục này chứa sản phẩm! không thể xóa!',
                            showConfirmButton: true,
                            showCancelButton: false,
                            icon: "error"
                        });
                    } else if (response[0] === 2) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops.',
                            text: 'Danh mục này chưa danh mục con! không thể xóa',
                            showConfirmButton: true,
                            showCancelButton: false,
                            icon: "error"
                        });
                    }
                }
            });
        }
    })
}

function checkStatus(iddh) {
    Swal.fire({
        title: 'Cập nhật?',
        text: "Bạn chắc chắn?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke!',
        cancelButtonText: 'No',
    }).then(async(result) => {
        if (result.isConfirmed) {
            let checkStatus = new FormData();

            checkStatus.append('iddh', iddh); //gửi lên user và pass để kiểm tra
            // checkStatus.append('Remember', remember);
            checkStatus.append('Action', 'updateStatus');
            await $.ajax({
                type: 'POST',
                url: 'controllers/ajax/order.php',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: checkStatus,
                success: async function(response) {
                    if (response.StatusCode == 0) {
                        await Swal.fire({
                            timer: 2000,
                            type: 'success',
                            title: 'Yeah',
                            showConfirmButton: false,
                            showCancelButton: false,
                            icon: "success"
                        });
                        window.location.href = "?ctrl=order"
                    } else if (response.StatusCode === 1) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops.',
                            showConfirmButton: true,
                            showCancelButton: false,
                            icon: "error"
                        });

                    }
                }
            });
        }

    })

}
$(document).ready(function() {


    jQuery(function($) {
            $("#clear").click(function(event) {
                event.preventDefault();
                $("#inputhinh").replaceWith('<input type="file" class="imagefet" name="img[]" id="inputhinh" accept="image/png, image/jpg, image/jpeg" multiple="multiple" style="display: none">');
                $("div.output-fet").replaceWith('<div class="output-fet"><output id="list"></output></div>');
                $(".boxshowimg").addClass("hidden");
            });
        })
        // $('#list img').css("width", "300px");
    jQuery(function($) {

        var count = 0;

        function handleFileSelect(evt) {
            var $fileUpload = $(".imagefet");
            count = count + parseInt($fileUpload.get(0).files.length);

            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                        document.getElementById('list').insertBefore(span, null);
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        $('.imagefet').change(function(evt) {
            handleFileSelect(evt);
            $(".boxshowimg").removeClass("hidden");
        });

    })







});