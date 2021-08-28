var url_sukien = '/quantri/sukien';
var url_sukien_action = url_sukien + '/action';
var url_fetch = '/quantri/getSuKien';

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
        // dateClick: function(info) {
        //     alert('clicked ' + info.dateStr);
        // },
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

                if (thongTinLichHen) {
                    let valiError = validSelect(thongTinLichHen);

                    if (!valiError.check) { addNewSuKien(thongTinLichHen, start, end); }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Đã xảy ra lỗi !',
                            text: valiError.mess,
                        });
                    }
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Đã xảy ra lỗi !',
                    text: 'Vui lòng chọn trước ngày hiện tại một ngày',
                });
            }
        },
        editable: true,
        eventResize: function(info, delta) {
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
                        resizeSuKien(info, start, end);
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
                Swal.fire({
                    icon: 'error',
                    title: 'Đã xảy ra lỗi !',
                    text: 'Vui lòng chọn trước ngày hiện tại một ngày',
                });
            }
        },
        eventDrop: function(info, delta)
        {
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
                        resizeSuKien(info, start, end);
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
                Swal.fire({
                    icon: 'error',
                    title: 'Đã xảy ra lỗi !',
                    text: 'Vui lòng chọn trước ngày hiện tại một ngày',
                }).then(() => {
                    info.revert();
                });
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

function updateSuKien(info) {
    console.log(info.event);
    // $.ajax({
    //     url: url_sukien_action,
    //     type:"POST",
    //     data:{
    //         title: info.event.title,
    //         start: info.event.start,
    //         end: info.event.end,
    //         id: info.event.id,
    //         type: 'update'
    //     },
    //     success:function(response)
    //     {
    //         alertResult(response);
    //     }
    // })
}

function resizeSuKien(info, start, end) {
    $.ajax({
        url: url_sukien_action,
        type:"POST",
        data:{
            start: start,
            end: end,
            id: info.event.id,
            type: 'resize'
        },
        success:function(response)
        {
            alertResult(response);
        }
    })
}

function alertResult(data) {
    console.log(data);
    if (data.success) {
        calendar.refetchEvents()
        Swal.fire({
            icon: 'success',
            title: data.titleMess,
            text: data.textMess,
            showConfirmButton: true,
            timer: 1000
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: data.titleMess,
            text: data.textMess,
        });
    }
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



