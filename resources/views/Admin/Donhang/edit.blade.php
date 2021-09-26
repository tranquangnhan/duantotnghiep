
@extends('Admin.layoutadmin')
@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row d-flex justify-content-center">
                    <div class="col-xl-10">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                </div>
                            </div>

                            <h4 class="header-title mt-0 mb-3">Sửa Cơ Sở</h4>

                            <form data-parsley-validate action="{{route('donhang.update',$data->iddh)}}" id="formadd" novalidate onsubmit="return submitForm()" method="post" enctype="multipart/form-data">
                                @csrf
                                {!! method_field('patch') !!}


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Tên khách hàng</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="idkh" class="form-control @error('idkh') border-error @enderror idkh" value="{{$data->idkh}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        <div class="form-group">
                                            <label for="">Tên cơ sở</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="coso" class="form-control @error('coso') border-error @enderror coso" value="{{$data->idcs}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tên nhân viên</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="nhanvien" class="form-control @error('nhanvien') border-error @enderror nhanvien" value="{{$data->nhanvien}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tổng tiền</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="tongtien" class="form-control @error('tongtien') border-error @enderror tongtien" value="{{$data->tongtien}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mã giảm giá</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="magiamgia" class="form-control @error('magiamgia') border-error @enderror magiamgia" value="{{$data->magg}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tổng tiền đã giảm</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="tonggg" class="form-control @error('tonggg') border-error @enderror tonggg" value="{{$data->tongtiengg}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ghi chú</label><span style="color:red;"> (*)</span>
                                            <textarea type="text"  rows="4" cols="50" name="ghichu" class="form-control @error('ghichu') border-error @enderror ghichu" value="{{$data->ghichu}}"  parsley-trigger="change" required
                                                   placeholder="Ghi chú" ></textarea>
                                        </div>



                                    </div>

                                </div>

                                <div class="form-group text-right mb-0 mt-5">
                                    <input type="submit" name="them" class="btn btn-primary waves-effect waves-light mr-1" value="Sửa" id='add_product'>
                                    <a href="/quantri/danhmuc" clas="btn btn-secondary waves-effect waves-light">Hủy</a>
                                </div>

                            </form>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>
@endsection
