
@extends('Admin/layoutadmin')
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

                            <h4 class="header-title mt-0 mb-3">Nhập Tên Cơ Sở</h4>

                            <form >
                                @csrf


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Tên Cơ Cở</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="name" class="form-control @error('name') border-error @enderror name" value="{{old('name')}}"  parsley-trigger="change" required
                                                   placeholder="Tên Danh Mục" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">  Chọn Tỉnh/Thành Phố</label><span style="color:red;"> (*)</span>
                                            <div>
                                              <select class="form-control input-sm m-bot15 choose city" name="city" id="city"  >
                                                <option value="">-----{{__('Chọn Thành Phố')}}-----</option>
                                                @foreach($city as $key => $ci)
                                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="">
                                        <label class="">{{__('Chọn Quận/Huyện')}} <span style="color:red;"> (*)</span></label>
                                            <div>
                                              <select  name="province" id="province" class="form-control input-sm m-bot15 choose province"  >
                                                <option value="">-----{{__('Chọn Quận/Huyện')}}-----</option>
                                              </select>
                                          </div>
                                      </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="">
                                        <label class="">{{__('Chọn Xã/Phường')}} <span style="color:red;"> (*)</span></label>
                                            <div>
                                              <select name="wards" id="wards" class=" form-control input-sm m-bot15 wards" >
                                                <option value="">-----{{__('Chọn Xã/Phường')}}-----</option>
                                              </select>
                                          </div>
                                      </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-group text-right mb-0 mt-5">
                                    <input type="submit" name="them" class="btn btn-primary waves-effect waves-light mr-1 them" value="Thêm" id='add_product'>
                                    <a href="/admin/coso" clas="btn btn-secondary waves-effect waves-light">Hủy</a>
                                </div>

                            </form>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>
@endsection
