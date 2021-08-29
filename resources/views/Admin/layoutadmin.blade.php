<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="{{url('/')}}">
        <meta charset="utf-8" />
        <title>ADMIN - Manage</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="admin/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/css') }}/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin/css') }}/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin/css') }}/app.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="{{ asset('admin/css') }}/SweetAlert2.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" rel="stylesheet" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>

    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>

    <body>
        <input type="hidden" id="id_us" value="{{ auth()->user()->id }}">
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">


                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Xoá Tất Cả</small>
                                        </a>
                                    </span>Thông Báo
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Chào mừng bạn đến với admin
                                <b>admin</b>
                                <small class="text-muted">13 phút trước</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        Xem tất cả
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('admin/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                {{ auth()->user()->name }}<i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Chào mừng !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Tài khoản</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Cài đặt</span>
                    </a>


                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{url('/admin/logout')}}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Đăng xuất</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>


        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="{{asset('admin/images/logo-dark.png')}}" alt="" height="16">
                        </span>
                <span class="logo-sm">
                            <img src="{{asset('admin/images/logo-sm.png')}}" alt="" height="24">
                        </span>
            </a>
            <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="{{asset('admin/images/logo-light.png')}}" alt="" height="16">
                        </span>
                <span class="logo-sm">
                            <img src="{{asset('admin/images/logo-sm.png')}}" alt="" height="24">
                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
            <li>
                <button class="button-menu-mobile disable-btn waves-effect">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <h4 class="page-title-main"></h4>
            </li>

        </ul>

    </div>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="slimscroll-menu">

            <!-- User box -->
            <div class="user-box text-center">
                <img src="{{asset('admin/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                     class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"
                       aria-expanded="false"> {{ auth()->user()->name }} </a>
                    <div class="dropdown-menu user-pro-dropdown">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user mr-1"></i>
                            <span>Tài khoản</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings mr-1"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock mr-1"></i>
                            <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-log-out mr-1"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="text-muted">
                            <i class="mdi mdi-cog"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">

                    @if(!empty(Auth::user()->role == 1))
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-page-layout-sidebar-left"></i>
                                <span> Nhân sự</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{url('quantri/nhansu')}}">Danh sách </a></li>
                                <li><a href="{{url('quantri/nhansu/create')}}">Thêm mới </a></li>
                            </ul>
                        </li>
                    @endif
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Đặt Lịch</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Danh mục</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('quantri/danhmuc/create')}}">Thêm mới</a></li>
                            <li><a href="{{url('quantri/danhmuc')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Cơ sở</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('quantri/coso/create')}}">Thêm mới</a></li>
                            <li><a href="{{url('quantri/coso')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Dịch Vụ </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Lương </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Lịch </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Chấm Công </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/chamcong')}}">Chấm công </a></li>
                            <li><a href="{{url('/quantri/chamcong/cuatoi/' . auth()->user()->id)}}">Xem chấm công </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Sự kiện </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/sukien')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Khách Hàng</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span>Đặt lịch</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('/quantri/addfilm')}}">Thêm mới </a></li>
                            <li><a href="{{url('/quantri')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-page-layout-sidebar-left"></i>
                            <span> Đơn Hàng</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('quantri/donhang')}}">Danh sách</a></li>
                        </ul>
                    </li>


                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>

@yield('content')

<!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2020 &copy;phát triển bởi <a href="">Quang Nhân</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="mdi mdi-close"></i>
        </a>
        <h4 class="font-16 m-0 text-white">WEBSITE of nhân</h4>
    </div>
    <div class="slimscroll-menu">

        <div class="p-3">
            <div class="alert alert-warning" role="alert">
                <strong>Nhân, </strong>Được phát triển bởi Nhân.
            </div>
            <div class="mb-2">
                <img src="{{asset('admin/images/layouts/light.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked/>
                <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('admin/images/layouts/dark.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch"
                       data-bsStyle="{{ asset('admin/css') }}/bootstrap-dark.min.css"
                       data-appStyle="{{ asset('admin/css') }}/app-dark.min.css"/>
                <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('admin/images/layouts/rtl.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch"
                       data-appStyle="{{ asset('admin/css') }}/app-rtl.min.css"/>
                <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('admin/images/layouts/dark-rtl.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-rtl-mode-switch"
                       data-bsStyle="{{ asset('admin/css') }}/bootstrap-dark.min.css"
                       data-appStyle="{{ asset('admin/css') }}/app-dark-rtl.min.css"/>
                <label class="custom-control-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
            </div>

            <a href="https://1.envato.market/k0YEM" class="btn btn-danger btn-block mt-3" target="_blank"><i
                    class="mdi mdi-download mr-1"></i> Download Now</a>
        </div>
    </div>
</div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
        <i class="mdi mdi-cog-outline mdi-spin"></i> &nbsp;Chọn Themes
    </a>

    <!-- Vendor js -->
    <script src="{{ asset('admin/js') }}/vendor.min.js"></script>

        <script type="text/javascript">
    $(document).ready(function(){
        $('.them').click(function(){
          var name = $('.name').val();
          var city = $('.city').val();
          var province = $('.province').val();
          var wards = $('.wards').val();
          var _token = $('input[name="_token"]').val();

          $.ajax({
            url: '{{url("/quantri/add-dellivery")}}',
            method:'POST',
            data:{name:name,city:city,province:province,wards:wards,_token:_token},
            complete: function () {
        // Handle the complete event
        window.location.replace("quantri/coso");

        alert('thêm cơ sở thành công');
      }

            });
        });

    });


    $('.choose').on('change',function(){
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();

        var result = '';

        if(action=='city'){
            result = 'province';
        }else{
            result = 'wards';
        }
        $.ajax({

            url: '{{url("/quantri/select-dellivery")}}',
        //    cache: false,
        //      contentType: false,
        //     processData: false,
            method:'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success:function(data){
               $('#'+result).html(data);
            }
        });
    });

    </script>

    <!-- knob plugin -->
    <script src="{{ asset('admin/libs') }}/jquery-knob/jquery.knob.min.js"></script>

    <!--Morris Chart-->
    <script src="{{ asset('admin/libs') }}/morris-js/morris.min.js"></script>
    <script src="{{ asset('admin/libs') }}/raphael/raphael.min.js"></script>

    <!-- Dashboard init js-->
    <script src="{{ asset('admin/js') }}/pages/dashboard.init.js"></script>



    <script src="{{ asset('admin/js') }}/pages/datatables.init.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/buttons.flash.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/buttons.print.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('admin/libs') }}/datatables/dataTables.select.min.js"></script>
    <script src="{{ asset('admin/libs') }}/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('admin/libs') }}/pdfmake/vfs_fonts.js"></script>
    <!-- text editor -->
        <!-- App js -->
    <script src="{{ asset('admin/js') }}/app.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <!-- Plugins js -->
    <script src="{{ asset('admin/libs') }}/katex/katex.min.js"></script>
    <script src="{{ asset('admin/libs') }}/quill/quill.min.js"></script>

    <!-- init js -->
    <script src="{{ asset('admin/js') }}/pages/form-editor.init.js"></script>
    <!--end text editor -->
    <!-- sweet alert -->
    <script src="{{ asset('admin/js') }}/SweetAlert2.js"></script>
    <!-- end sweet alert -->
    <script src="{{ asset('admin/js') }}/home.js"></script>
    {{-- <script src="../lib/ckeditor/ckeditor.js"></script> --}}
    {{-- <script src="{{ asset('admin/js') }}/ckfinder.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"> </script>
    <script src="{{ asset('admin/js') }}/validate.js"></script>
    <script src="{{ asset('admin/js') }}/longdeptrai.js"></script>
    @yield('script')
</body>

</html>
