var danhSachSuKien = [
    {'ten': 'Sự kiện'},
    {'ten': 'Xin nghỉ'},
    {'ten': 'Meeting'}
]

var loaiCanQuyenAdmin = [LOAI_SUKIEN, LOAI_MEETING];

var url_sukien = '/quantri/sukien';
var url_sukien_action = url_sukien + '/action';
var url_fetch = '/quantri/getSuKien';
var url_getNhanSu = '/quantri/getNhanSu';

var type_error = 'error';
var type_success = 'success';
var title_error = 'Đã xãy ra lỗi';
var text_error_date = 'Vui lòng chọn trước ngày hiện tại một ngày';
var text_error_permision = 'Bạn không có quyền sửa';
var notRevert = false;
var revert = true;

var id_us = $('#id_us').val();
var nhanSuLogin = getNhanSuNotAsync(id_us);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

var calendar;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
        },
        events: {
            url: url_fetch,
        },
        eventConstraint: {
            start: moment().format('YYYY-MM-DD'),
            end: '2100-01-01' // hard coded goodness unfortunately
        },
        eventClick: function(info) {
            // var startFormatDate = moment(info.event.start).format("YYYY-MM-DD");
            // var data = checkDate(info, startFormatDate);
            // if (data.isToDate) {


            // } else {
            //     sweetAlert(type_error, title_error, text_error_date, info, notRevert);
            // }
            // var start = moment(info.start).format("YYYY-MM-DD HH:mm:ss");
            // var end = moment(info.end).format("YYYY-MM-DD HH:mm:ss");

            getClickHTML(info);
        },
        select: function(info) {
            var startFormatDate = moment(info.start).format("YYYY-MM-DD");
            var data = checkDate(info, startFormatDate);
            if (data.isToDate) {
                Swal.fire({
                    title: 'Thông Tin Lịch Hẹn',
                    html: formSelectHTML(info),
                    customClass: {
                        popup: 'swalert-w800',
                    },
                    showConfirmButton: false
                });
            } else {
                sweetAlert(type_error, title_error, text_error_date, info, notRevert);
            }
        },
        editable: true,
        eventResize: function(info, delta) {
            var idUserAction = info.event.extendedProps.idns;
            if (checkUser(idUserAction) === true) {
                var startFormatDate = moment(info.event.start).format("YYYY-MM-DD");
                var data = checkDate(info, startFormatDate);
                if (data.isToDate) {
                    var start = moment(info.event.start).format("YYYY-MM-DD HH:mm:ss");
                    var end = moment(info.event.end).format("YYYY-MM-DD HH:mm:ss");
                    const confirmResize = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success ml-3',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });

                    confirmResize.fire({
                        title: 'Vui lòng xác nhận?',
                        text: "Sự kiện của bạn sẽ thay đổi!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Vâng, thay đổi!',
                        cancelButtonText: 'Không, hủy!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            resizeSuKien(info, start, end, idUserAction);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            confirmResize.fire(
                                'Đã hủy',
                                'Sự kiện của bạn không có gì thay đổi :)',
                                'info'
                            ).then(() => {
                                info.revert();
                            });
                        }
                    });
                } else {
                    sweetAlert(type_error, title_error, text_error_date, info, notRevert);
                }
            } else {
                sweetAlert(type_error, title_error, text_error_permision, info, revert);
            }
        },
        eventDrop: function(info, delta)
        {
            let idUserAction = info.event.extendedProps.idns;
            if (checkUser(idUserAction) === true) {
                var startFormatDate = moment(info.event.start).format("YYYY-MM-DD");
                var data = checkDate(info, startFormatDate);
                if (data.isToDate) {
                    var start = moment(info.event.start).format("YYYY-MM-DD HH:mm:ss");
                    var end = moment(info.event.end).format("YYYY-MM-DD HH:mm:ss");
                    const confirmResize = Swal.mixin({
                        customClass: {
                        confirmButton: 'btn btn-success ml-3',
                        cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });

                    confirmResize.fire({
                        title: 'Vui lòng xác nhận?',
                        text: "Sự kiện của bạn sẽ thay đổi!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Vâng, thay đổi!',
                        cancelButtonText: 'Không, hủy!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            resizeSuKien(info, start, end, idUserAction);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            confirmResize.fire(
                                'Đã hủy',
                                'Sự kiện của bạn không có gì thay đổi :)',
                                'info'
                            ).then(() => {
                                info.revert();
                            });
                        }
                    })
                } else {
                    sweetAlert(type_error, title_error, text_error_date, info, revert);
                }
            } else {
                sweetAlert(type_error, title_error, text_error_permision, info, revert);
            }
        },
    });

    calendar.render();
});

function hideLabelError() {
    var label = $('.error_');
    label.hide();
}

function validSelect(data)
{
    hideLabelError();
    let check = false;

    if (data.title == '') {
        check = true;
        var mess = 'Bạn chưa nhập tiêu đề';
        var idErrorLabel = 'titleError';
        showError(idErrorLabel, mess);
    }

	if (loaiCanQuyenAdmin.indexOf(parseInt(data.loai)) != -1) {
        if (nhanSuLogin.role == ROLE_NHANVIEN) {
            check = true;
            var mess = "Bạn không có quyền tạo lịch hẹn loại này";
            var idErrorLabel = 'loaiError';
            showError(idErrorLabel, mess);
        }
	}

    if (!checkFormatDateTime(data.start)) {
        check = true;
        var mess = "Thời gian phải theo format datetime <br> (0000-00-00 00:00:00)";
        var idErrorLabel = 'startError';
        showError(idErrorLabel, mess);
    }

    return {
        "check": check,
        "mess": mess
    }
}

function checkFormatDateTime(dateTime) {
    var format = "YYYY-MM-DD HH:mm:ss";
    return moment(dateTime, format, true).isValid();
}

function showError(id, mess) {
    var id = $('#' + id);
    id.html(mess);
    id.show();
}

function formSelectHTML(info) {
	const start = moment(info.start).format("YYYY-MM-DD HH:mm:ss");
    const end = moment(info.end).format("YYYY-MM-DD HH:mm:ss");
    let html =
    `
    <div class="select-sukien text-left">
        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="loai">Loại <span style="color: red;">(*)</span></label>
                    <select class="form-control" id="loai">
                        <option value="0">Sự kiện</option>
                        <option value="1">Xin nghỉ</option>
                        <option value="2">Meeting</option>
                    </select>
					<label class="error_" style="color: red;" id="loaiError"></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="">Tiêu Đề <span style="color: red;">(*)</span></label>
                    <input type="text" class="form-control" id="title">
					<label class="error_" style="color: red;" id="titleError"></label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
				<div class="col-6 pl-0">
					<label for="start">Thời gian bắt đầu <span style="color: red;">(Date/time)</span></label>
					<input type="text" class="form-control" value="${start}"  id="start" name="">
					<label class="error_" style="color: red;" id="startError"></label>
				</div>
				<div class="col-6 pr-0">
					<label for="end">Kết thúc</label>
					<input type="text" class="form-control" value="${end}" id="end" name="">
					<label class="error_" style="color: red;" id="endError"></label>
				</div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="">Mô tả</label>
                    <textarea type="text" class="form-control" cols="10" rows="5" id="mota"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <button class="btn btn-primary" onclick="luuLichHen(${JSON.stringify(info).split('"').join("&quot;")});">Lưu lịch</button>
                    <button class="btn btn-danger" onclick="hideSweetalert();">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    `;

    return html;
}

function luuLichHen(info) {
	var start = $('#start').val();
	var end = $('#end').val();

    const thongTinLichHen = {
        title: $('#title').val(),
        mota: $('#mota').val(),
        loai: $('#loai').val(),
		start: start,
		end: end
    }

    var error = false;
    var errorMess = '';

    var validate = validSelect(thongTinLichHen);
    if (validate.check) {
        error = true;
        errorMess = validate.mess;
    }

    if (!error)
    { addNewSuKien(thongTinLichHen, start, end); }
    // else
    // {
    //     sweetAlert(type_error, title_error, errorMess, info, notRevert);
    // }
}

function hideSweetalert() {
    swal.close();
}

function getClickHTML(info) {
    var idUser = info.event.extendedProps.idns;
    if (checkUser(idUser)) {
        var html = editHTML(info);
        Swal.fire({
            title: 'Thông Tin Lịch Hẹn',
            html: html,
            customClass: {
                content: 'content-class',
                popup: 'swalert-w800',
            },
            showConfirmButton: false,
        });
    } else {
        // Show thông tin lịch hẹn
        getInfoNhanSu(info, idUser);
    }
}

function checkStartBiggerTomorrow(start) {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowFormatDate = moment(tomorrow).format("YYYY-MM-DD");
    const startFormatDate = moment(start).format("YYYY-MM-DD");

    if (tomorrowFormatDate < startFormatDate) {
        return true;
    } else {
        return false;
    }
}

function viewHTML(info, nhansu) {
    const event = info.event;
    const eventedProps = info.event.extendedProps;
    const start = moment(event.start).format("HH:mm:ss DD-MM-YYYY");
    const end = moment(event.end).format("HH:mm:ss DD-MM-YYYY");
    const trangThaiSuKien = getTrangThaiSuKien(eventedProps);
    const startBiggerTomorrow = checkStartBiggerTomorrow(event.start);
    if (eventedProps.mota == null) { eventedProps.mota = ''; }

    var html =
    `
    <div class="view-sukien text-left mt-2">
        <div class="row">
            <div class="col-5 p-0 text-center">
                <img src="image/avt.png" class="img-fluid mx-auto" style="width:100px" alt="">
                <br><b>${nhansu.name}</b>
                <div class="time">
                    <span>Từ: </span> ${start} <br>
                    <span>Đến: </span> ${end}
                </div>
            </div>
            <div class="col-7" style="padding-right: 0px;">
                <h5 class="m-0"><b>${event.title}</b></h5>
                <span class="badge bg-${trangThaiSuKien.classe}">${trangThaiSuKien.ten}</span>
                <p>${eventedProps.mota}</p> `;
            if (!eventedProps.loai == LOAI_SUKIEN) {
                if (eventedProps.trangthai == STATUS_XIN_NGHI) {
                    if (startBiggerTomorrow) {
                        html +=
                        `<button class="btn btn-primary float-right waves-effect width-md waves-light" onclick="updateTrangThaiXinNghi(`+event.id+`, `+nhansu.id+`, `+STATUS_ACCEPT_XIN_NGHI+`, '`+start+`');">
                            Cấp phép
                        </button>`;
                    } else {
                        html +=
                        `<button class="btn btn-secondary float-right waves-effect width-md waves-light">
                            Cấp phép
                        </button>`;
                    }
                }
                if (eventedProps.trangthai == STATUS_ACCEPT_XIN_NGHI) {
                    if (startBiggerTomorrow) {
                        html +=
                        `<button class="btn btn-danger float-right waves-effect width-md waves-light" onclick="updateTrangThaiXinNghi(`+event.id+`, `+nhansu.id+`, `+STATUS_XIN_NGHI+`, '`+start+`');">
                            Hủy cấp phép
                        </button>`;
                    } else {
                        html +=
                        `<button class="btn btn-secondary float-right waves-effect width-md waves-light">
                            Hủy cấp phép
                        </button>`;
                    }
                }
            }
    html += `</div>
        </div>
    </div>`;

    return html;
}

function getTrangThaiSuKien(eventedProps) {
    var ten = '';
    var classe = '';
    if (eventedProps.loai == LOAI_SUKIEN) {
        ten = 'Sự kiện';
        classe = 'success';
    }
    if (eventedProps.loai == LOAI_XIN_NGHI) {
        ten = 'Xin nghỉ';
        if (eventedProps.trangthai == STATUS_XIN_NGHI) {
            classe = 'dark';
        } else if (eventedProps.trangthai == STATUS_ACCEPT_XIN_NGHI) {
            classe = 'info';
        }
    }

    return {
        ten: ten,
        classe: classe
    }
}

function getNhanSuNotAsync(id) {
    var nhansu = $.ajax({
        url: url_getNhanSu + '/' + id,
        type: "GET",
        async: false,
        success:function(response)
        {
            if (response.success) {
                return response.nhansu;
            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, null, notRevert);
            }
        }
    });

    return nhansu.responseJSON.nhansu;
}

function getInfoNhanSu(info, idns) {
    $.ajax({
        url: url_getNhanSu + '/' + idns,
        type: "GET",
        success:function(response)
        {
            if (response.success) {
                let nhansu = response.nhansu;

                var html = viewHTML(info, nhansu);
                Swal.fire({
                    title: 'Thông Tin Lịch Hẹn',
                    html: html,
                    customClass: {
                        popup: 'swalert-w800',
                    },
                    showConfirmButton: false,
                });

            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, null, notRevert);
            }
        }
    });
}

function editHTML(info) {
    var mota = info.event.extendedProps.mota;
    const event = info.event;
    const idSukien = info.event.id;
    const idUserAction = info.event.extendedProps.idns;
    const loai = getLoaiSuKien(info.event.extendedProps.loai);
    const startBiggerTomorrow = checkStartBiggerTomorrow(event.start);
    const start = moment(event.start).format("YYYY-MM-DD HH:mm:ss");
    const end = moment(event.end).format("YYYY-MM-DD HH:mm:ss");

    if (mota == null) {
        mota = '';
    }
    var html =
    `
    <div class="select-sukien text-left">
        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="loai">Loại <span style="color: red;">(*)</span></label>
                    <select class="form-control" id="loai">
                        ${loai}
                    </select>
                    <label class="error_" style="color: red;" id="loaiError"></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="">Tiêu Đề <span style="color: red;">(*)</span></label>
                    <input type="text" class="form-control" value="${info.event.title}" id="title">
                    <label class="error_" style="color: red;" id="titleError"></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-6 pl-0">
                    <label for="start">Thời gian bắt đầu <span style="color: red;">(Date/time)</span></label>
                    <input type="text" class="form-control" value="${start}"  id="start" name="">
                    <label class="error_" style="color: red;" id="startError"></label>
                </div>
                <div class="col-6 pr-0">
                    <label for="end">Kết thúc</label>
                    <input type="text" class="form-control" value="${end}" id="end" name="">
                    <label class="error_" style="color: red;" id="endError"></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">
                    <label for="">Mô tả</label>
                    <textarea type="text" class="form-control" cols="10" rows="5" id="mota">${mota}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 p-0">`;
                    if (startBiggerTomorrow) {
                        html +=
                        `<button class="btn btn-primary" onclick="updateSuKien(`+idSukien+`, `+idUserAction+`);">Cập nhật</button>
                        <button class="btn btn-danger" onclick="deleteSuKien(`+idSukien+`, `+idUserAction+`);">Xóa</button>`;
                    } else {
                        html +=
                        `<button class="btn btn-secondary">Cập nhật</button>
                        <button class="btn btn-secondary">Xóa</button>`;
                    }
                    html += `
                </div>
            </div>
        </div>
    </div>
    `;

    return html;
}

function getLoaiSuKien(loai) {
    var html = '';
    danhSachSuKien.forEach((element, index) => {
        html += `<option `+((loai == index) ? 'selected' : '')+` value="${index}">${element.ten}</option>`;
    });
    return html;
}

function addNewSuKien(thongTinLichHen, start, end)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url_sukien_action,
        type: "POST",
        data: {
            title: thongTinLichHen.title,
            mota: thongTinLichHen.mota,
            loai: thongTinLichHen.loai,
            start: start,
            end: end,
            type: 'add'
        },
        success:function(data)
        {
            alertResult(data);
        }
    });
}

function checkDate(info, startFormatDate)
{
    var today = moment(new Date()).format("YYYY-MM-DD");
    if (startFormatDate >= today) {
        var check = true;
    } else {
        var check = false;
    }

    return {
        "isToDate": check,
    }
}

function updateSuKien(idSukien, idUserAction) {
    var thongTinLichHen = {
        title: $('#title').val(),
        mota: $('#mota').val(),
        loai: $('#loai').val(),
        start: $('#start').val(),
        end: $('#end').val(),
    }

    var error = false;
    var errorMess = '';
    var validate = validSelect(thongTinLichHen);

    if (validate.check) {
        error = true;
        errorMess = validate.mess;
    }

    if (!error) {
        const confirmUpdate = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-3',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        confirmUpdate.fire({
            title: 'Vui lòng xác nhận?',
            text: "Sự kiện của bạn sẽ thay đổi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Vâng, thay đổi!',
            cancelButtonText: 'Không, hủy!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                subUpdateSuKien(idSukien, idUserAction, thongTinLichHen);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                confirmUpdate.fire(
                    'Đã hủy',
                    'Sự kiện của bạn không có gì thay đổi :)',
                    'info'
                );
            }
        });
    }
    // else {
    //     const info = null;
    //     sweetAlert(type_error, title_error, errorMess, info, notRevert);
    // }
}

function deleteSuKien(idSukien, idUserAction) {
    const confirmUpdate = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-3',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    confirmUpdate.fire({
        title: 'Vui lòng xác nhận?',
        text: "Sự kiện của bạn sẽ xóa mất!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Vâng, xóa!',
        cancelButtonText: 'Không, hủy!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            subDeleteSuKien(idSukien, idUserAction);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            confirmUpdate.fire(
                'Đã hủy',
                'Sự kiện của bạn không có gì thay đổi :)',
                'info'
            );
        }
    });
}

function subDeleteSuKien(idSukien, idUserAction) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            id: idSukien,
            idns: idUserAction,
            type: 'delete'
        },
        success:function(response)
        {
            if (response.success) {
                calendar.refetchEvents()
                sweetAlert(type_success, response.titleMess, response.textMess, null, notRevert);
            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, null, notRevert);
            }
        }
    })
}

function resizeSuKien(info, start, end, idns) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            start: start,
            end: end,
            id: info.event.id,
            idns: idns,
            type: 'resize'
        },
        success:function(response)
        {
            if (response.success) {
                calendar.refetchEvents()
                sweetAlert(type_success, response.titleMess, response.textMess, info, notRevert);
            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, info, revert);
            }
        }
    })
}

function subUpdateSuKien(idSukien, idUserAction, thongTinLichHen) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            title: thongTinLichHen.title,
            mota: thongTinLichHen.mota,
            loai: thongTinLichHen.loai,
            start: thongTinLichHen.start,
            end: thongTinLichHen.end,
            id: idSukien,
            idns: idUserAction,
            type: 'update'
        },
        success:function(response)
        {
            if (response.success) {
                calendar.refetchEvents()
                sweetAlert(type_success, response.titleMess, response.textMess, null, notRevert);
            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, null, notRevert);
            }
        }
    })
}

function updateTrangThaiXinNghi(idSukien, nhanSu, trangThai, start) {
    if (nhanSuLogin.role == ROLE_ADMIN) {
        subTrangThai(idSukien, nhanSu, trangThai, start);
    } else {
        sweetAlert(type_error, title_error, text_error_permision, info, revert);
    }

}

function subTrangThai(idSukien, nhanSu, trangThai, start) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            trangThai: trangThai,
            id: idSukien,
            idns: nhanSu.id,
            start: start,
            type: 'updateTrangThaiXinNghi'
        },
        success:function(response)
        {
            if (response.success) {
                calendar.refetchEvents();
                sweetAlert(type_success, response.titleMess, response.textMess, null, notRevert);
            } else {
                sweetAlert(type_error, response.titleMess, response.textMess, null, notRevert);
            }
        }
    })
}

function alertResult(data) {
    if (data.success) {
        calendar.refetchEvents()
        Swal.fire({
            icon: 'success',
            title: data.titleMess,
            text: data.textMess,
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: data.titleMess,
            text: data.textMess,
        });
    }
}

function checkUser(idUserAction) {
    if (id_us == idUserAction) {
        return true;
    } else {
        return false;
    }
}

function sweetAlert(icon, title, text, info, revert) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    }).then(() => {
        if (revert == true) {
            info.revert();
        }
    });
}

