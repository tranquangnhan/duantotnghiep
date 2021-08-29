var danhSachSuKien = [
    {'ten': 'Sự kiện'},
    {'ten': 'Xin nghỉ'},
    {'ten': 'Meeting'}
]

var id_us = $('#id_us').val();
var url_sukien = '/quantri/sukien';
var url_sukien_action = url_sukien + '/action';
var url_fetch = '/quantri/getSuKien';

var type_error = 'error';
var type_success = 'success';
var title_error = 'Đã xãy ra lỗi';
var text_error_date = 'Vui lòng chọn trước ngày hiện tại một ngày';
var text_error_permision = 'Bạn không có quyền sửa';
var notRevert = false;
var revert = true;

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
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {
            url: url_fetch,
        },
        eventConstraint: {
            start: moment().format('YYYY-MM-DD'),
            end: '2100-01-01' // hard coded goodness unfortunately
        },
        eventClick: function(info) {
            var startFormatDate = moment(info.event.start).format("YYYY-MM-DD");
            var data = checkTodate(info, startFormatDate);
            if (data.isToDate) {
                var start = moment(info.start).format("YYYY-MM-DD HH:mm:ss");
                var end = moment(info.end).format("YYYY-MM-DD HH:mm:ss");

                var html = getClickHTML(info);

                Swal.fire({
                    title: 'Thông Tin Lịch Hẹn',
                    html: html,
                    showConfirmButton: false,
                });
            } else {
                sweetAlert(type_error, title_error, text_error_date, info, notRevert);
            }
        },
        select: async function(info) {
            var startFormatDate = moment(info.start).format("YYYY-MM-DD");
            var data = checkTodate(info, startFormatDate);
            if (data.isToDate) {
                var start = moment(info.start).format("YYYY-MM-DD HH:mm:ss");
                var end = moment(info.end).format("YYYY-MM-DD HH:mm:ss");
                const { value: thongTinLichHen } = await Swal.fire({
                    title: 'Thông Tin Lịch Hẹn',
                    html: formSelectHTML(),
                    focusConfirm: false,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Hủy',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Gửi',
                    preConfirm: () => {
                        return {
                            "title": document.getElementById('title').value,
                            "mota": document.getElementById('mota').value,
                            "loai": document.getElementById('loai').value
                        }
                    }
                });
                if (thongTinLichHen)
                {
                    let valiError = validSelect(thongTinLichHen);
                    if (!valiError.check) { addNewSuKien(thongTinLichHen, start, end); }
                    else {
                        sweetAlert(type_error, title_error, valiError.mess, info, notRevert);
                    }
                }
            } else {
                sweetAlert(type_error, title_error, text_error_date, info, notRevert);
            }
        },
        editable: true,
        eventResize: function(info, delta) {
            var idUserAction = info.event.extendedProps.idns;
            if (checkUser(idUserAction) === true) {
                var startFormatDate = moment(info.event.start).format("YYYY-MM-DD");
                var data = checkTodate(info, startFormatDate);
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
                var data = checkTodate(info, startFormatDate);
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

function validSelect (data)
{
    let check = false;

    if (data.title == '') {
        var mess = 'Bạn chưa nhập tiêu đề';
        check = true;
    }

    return {
        "check": check,
        "mess": mess
    }
}

function formSelectHTML()
{
    let html =
    `
    <div class="select-sukien text-left">
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="loai">Loại <span style="color: red;">(*)</span></label>
                </div>
                <div class="col-9">
                    <select class="form-control" id="loai">
                        <option value="0">Sự kiện</option>
                        <option value="1">Xin nghỉ</option>
                        <option value="2">Meeting</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="">Tiêu Đề <span style="color: red;">(*)</span></label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" id="title">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="">Mô tả</label>
                </div>
                <div class="col-9">
                    <textarea type="text" class="form-control" id="mota"></textarea>
                </div>
            </div>
        </div>
    </div>
    `;

    return html;
}

function getClickHTML(info) {
    var idUserAction = info.event.extendedProps.idns;
    if (checkUser(idUserAction)) {
        var html = editHTML(info);
    } else {
        var html = viewHTML(info);
    }

    return html;
}

function viewHTML(info) {
    var idUser = info.event.extendedProps.idns;
    var nhansu = getInfoNhanSu(idUser);
    var mota = info.event.extendedProps.mota;
    var idSukien = info.event.id;
    var loai = info.event.extendedProps.loai;
    if (mota == null) {
        mota = '';
    }
    var html =
    `
    <div class="select-sukien text-left">
        <div class="row">
            <div class="col-5 p-0 text-center">
                <img src="image/avt.png" class="img-fluid mx-auto" style="width:100px" alt="">
                <br><b>Long Nguyễn</b>
                <div class="time">
                    <span>Từ: </span> 2021-09-03 00:00:00 <br>
                    <span>Đến: </span> 2021-09-04 00:00:00
                </div>
            </div>
            <div class="col-7" style="padding-right: 0px;">
                <h5 class="m-0"><b>Xin nghỉ ngày 28/9/2001</b></h5>
                <h6  class="my-1"><span  style="text-decoration: underline;">Xin nghi</span> <span class="badge bg-dark">Chưa cấp phép</span> </h6>
                <p>Vào hôm 28/9 em có lịch học 2 buổi sáng và chiều, em xin phép được nghỉ vào 2 hôm đó</p>
                <button class="btn btn-primary">Cấp phép</button>
            </div>
        </div>

    </div>
    `;

    return html;
}

function getInfoNhanSu(idns) {  
    $.ajax({
        url: '',
        type: "GET",
        async: false,
        success:function(data)
        {
            console.log(data);
        }
    });
}

function editHTML(info) {
    var mota = info.event.extendedProps.mota;
    var idSukien = info.event.id;
    var idUserAction = info.event.extendedProps.idns;
    var loai = getLoaiSuKien(info.event.extendedProps.loai);
    if (mota == null) {
        mota = '';
    }
    var html =
    `
    <div class="select-sukien text-left">
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="loai">Loại <span style="color: red;">(*)</span></label>
                </div>
                <div class="col-9">
                    <select class="form-control" id="loai">
                        ${loai}
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="">Tiêu Đề <span style="color: red;">(*)</span></label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" value="${info.event.title}" id="title">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="">Mô tả</label>
                </div>
                <div class="col-9">
                    <textarea type="text" class="form-control" id="mota">${mota}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-9">
                    <button class="btn btn-primary" onclick="updateSuKien(`+idSukien+`, `+idUserAction+`);">Cập nhật</button>
                    <button class="btn btn-danger" onclick="deleteSuKien(`+idSukien+`, `+idUserAction+`);">Xóa</button>
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

function checkTodate(info, startFormatDate)
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
    }

    let valiError = validSelect(thongTinLichHen);
    if (!valiError.check) {
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
                subUpdateSuKien(idSukien, idUserAction, thongTinLichHen.title, thongTinLichHen.mota, thongTinLichHen.loai);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                confirmUpdate.fire(
                    'Đã hủy',
                    'Sự kiện của bạn không có gì thay đổi :)',
                    'info'
                );
            }
        });
    }
    else {
        sweetAlert(type_error, title_error, valiError.mess, null, notRevert);
    }
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

function subUpdateSuKien(idSukien, idUserAction, title, mota, loai) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            title: title,
            mota: mota,
            loai: loai,
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

function checkUser(id_us_action) {
    if (id_us == id_us_action) {
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

$(function() {



    // var calendar = $('#calendar123').fullCalendar({
    //     editable:true,
    //     header: {
    //         left:'prev,next today',
    //         center:'title',
    //         right:'month,agendaWeek,agendaDay'
    //     },
    //     events: url_sukien,
    //     selectable: true,
    //     selectHelper: true,
    //     // select: async function(start, end, allDay)
    //     // {
    //     //     var start_ = moment(start).format("YYYY-MM-DD HH:mm:ss");
    //     //     var end_ = moment(end).format("YYYY-MM-DD HH:mm:ss");

    //     //     var today = moment(new Date()).format("YYYY-MM-DD");
    //     //     var start_format_date = moment(start).format("YYYY-MM-DD");

    //     //     if (start_format_date >= today) {
    //     //         const { value: thongTinLichHen } = await Swal.fire({
    //     //             title: 'Thông Tin Lịch Hẹn',
    //     //             html: formSelectHTML(),
    //     //             focusConfirm: false,
    //     //             showCancelButton: true,
    //     //             cancelButtonColor: '#d33',
    //     //             cancelButtonText: 'Hủy',
    //     //             showConfirmButton: true,
    //     //             confirmButtonColor: '#3085d6',
    //     //             confirmButtonText: 'Gửi',
    //     //             preConfirm: () => {
    //     //                 return {
    //     //                     "title": document.getElementById('title').value,
    //     //                     "mota": document.getElementById('mota').value,
    //     //                     "loai": document.getElementById('loai').value
    //     //                 }
    //     //             }
    //     //         });

    //     //         if (thongTinLichHen) {
    //     //             let valiError = validSelect(thongTinLichHen);

    //     //             if (!valiError.check) { addNewSuKien(thongTinLichHen, start_, end_); }
    //     //             else {
    //     //                 Swal.fire({
    //     //                     icon: 'error',
    //     //                     title: 'Đã xảy ra lỗi !',
    //     //                     text: valiError.mess,
    //     //                 });
    //     //             }
    //     //         }
    //     //     } else {
    //     //         Swal.fire({
    //     //             icon: 'error',
    //     //             title: 'Đã xảy ra lỗi !',
    //     //             text: 'Vui lòng chọn trước ngày hiện tại một ngày',
    //     //         });
    //     //     }
    //     // },
    //     // editable:true,
    //     // eventResize: function(event, delta)
    //     // {

    //     // },
    //     // eventDrop: function(event, delta)
    //     // {
    //     //     var start = moment(event.start).format("YYYY-MM-DD HH:mm:ss");
    //     //     var end = moment(event.end).format("YYYY-MM-DD HH:mm:ss");
    //     //     var title = event.title;
    //     //     var id = event.id;

    //     //     $.ajax({
    //     //         url: url_sukien_action,
    //     //         type:"POST",
    //     //         data:{
    //     //             title: title,
    //     //             start: start,
    //     //             end: end,
    //     //             id: id,
    //     //             type: 'update'
    //     //         },
    //     //         success:function(response)
    //     //         {
    //     //             calendar_sukien.fullCalendar('refetchEvents');
    //     //             alert("Event Updated Successfully");
    //     //         }
    //     //     })
    //     // },

    //     // eventClick:function(event)
    //     // {
    //     //     if(confirm("Are you sure you want to remove it?"))
    //     //     {
    //     //         var id = event.id;
    //     //         $.ajax({
    //     //             url: url_sukien_action,
    //     //             type:"POST",
    //     //             data:{
    //     //                 id:id,
    //     //                 type:"delete"
    //     //             },
    //     //             success:function(response)
    //     //             {
    //     //                 calendar_sukien.fullCalendar('refetchEvents');
    //     //                 alert("Event Deleted Successfully");
    //     //             }
    //     //         })
    //     //     }
    //     // }
    // });
});



