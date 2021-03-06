@extends('Admin/layoutadmin')
@section('content')
    <style>
        #imageA img{
            width: 30%;
            margin-left: 5px;
        }
        .wrapper {

            width: 45%;
            height: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper i {
            font-size: 25pt;
        }

        .file-upload {

            height: 60px;
            width: 60px;
            border-radius: 100px;
            position: relative;

            display: flex;
            justify-content: center;
            align-items: center;

            border: 4px solid #FFFFFF;
            overflow: hidden;
            background-image: linear-gradient(to bottom, #2590EB 50%, #FFFFFF 50%);
            background-size: 100% 200%;
            transition: all 1s;
            color: #FFFFFF;
            font-size: 100px;
        }

        input[type='file'] {

            height: 100px;
            width: 100px;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;

        }


        :hover {

            background-position: 0 -100%;

            color: #2590EB;

        }

    </style>


    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <h4 class="header-title mt-0 mb-3 btn btn-success">SỬA THÔNG TIN NHÂN SỰ</h4>
                            <form data-parsley-validate action="{{route('nhansu.update',$data[0]['id'])}}" id="formadd" role="form"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                {!! method_field('patch') !!}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Tên nhân viên</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="tennv" value="{{$data[0]['name']}}"
                                                   parsley-trigger="change"
                                                   placeholder="Tên nhân viên" class="form-control">
                                            @error('tennv')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Chức vụ</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="chucvu" value="{{$data[0]['chucvu']}}"
                                                   parsley-trigger="change"
                                                   placeholder="Chức vụ" class="form-control">
                                            @error('chucvu')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Đổi mật khẩu</label><span style="color:red;"> (*)</span>
                                            <input type="password" name="matkhau" value=""
                                                   parsley-trigger="change"
                                                   placeholder="Mật khẩu" class="form-control">
                                        </div>
                                        <input type="hidden" name="pass" value="{{$data[0]['password']}}">

                                        <div class="form-group">
                                            <label for="">Lương </label><span style="color:red;"> (*)</span>
                                            <input type="number" name="luong" value="{{$data[0]['luong']}}"
                                                   parsley-trigger="change"
                                                   placeholder="Mức lương" class="form-control">
                                            @error('luong')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Năm sinh</label><span style="color:red;"> (*)</span>
                                            <select name="namsinh" class="form-control">
                                                <?php
                                                $year = date('Y') - 16;
                                                $min = $year - 60;
                                                $max = $year;
                                                for ($i = $max; $i >= $min; $i--) {
                                                ?>
                                                <option
                                                    value="{{$i}}" <?php if ($i == $data[0]['namsinh']) echo 'selected';?>>{{$i}}</option>
                                                ;
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Giới tính</label><span style="color:red;"> (*)</span>
                                            <select class="form-control" name="gioitinh">
                                                <option
                                                    value="0" <?php if ($data[0]['gioitinh'] == 0) echo 'selected';?>>
                                                    Nam
                                                </option>
                                                <option
                                                    value="1" <?php if ($data[0]['gioitinh'] == 1) echo 'selected';?>>Nữ
                                                </option>
                                                <option
                                                    value="2" <?php if ($data[0]['gioitinh'] == 2) echo 'selected';?>>
                                                    LGBT
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Rule</label><span style="color:red;"> (*)</span>
                                            <select class="form-control" name="role">
                                                <option value="0" <?php if ($data[0]['role'] == 0) echo 'selected';?>>
                                                    CTV
                                                </option>
                                                <option value="1" <?php if ($data[0]['role'] == 1) echo 'selected';?>>
                                                    Admin
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Dịch vụ</label><span style="color:red;"> (*)</span>
                                             <label for="">Dịch vụ</label><span style="color:red;"> (*)</span>
                                            <select class="form-control" name="dichvu">
                                                @foreach($DichVu as $id => $dvkh)
                                                    <option
                                                        value="{{$dvkh->id}}" <?php if ($data[0]['iddv'] == $dvkh->id) echo 'selected';?>>{{$dvkh->tendv}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="formFile" class="form-label">Tải ảnh nhân viên</label>
                                                    <br>
                                                    <div class="wrapper">
                                                        <div class="file-upload">
                                                            <input type="file" id="files" name="urlAnh[]" multiple>
                                                            <i class="fa fa-arrow-up"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="img" value="{{$data[0]['img']}}">
                                                <div class="col-md-6">

                                                    <?php
                                                    $img= explode(",", $data[0]['img']);
                                                    ?>

                                                    @foreach($img as $idAnh => $Anh)
                                                            <img class="imageS1"
                                                                 src="{{asset('admin/images/users')}}{{'/'.$Anh}}"
                                                                 width="45%"/>
                                                    @endforeach
                                                        <div id="imageA"></div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-md-12">
                                            <label class="form-label">Đánh giá</label>
                                            <textarea name="danhgia" class="form-control" id="mytextarea" cols="25"
                                                      rows="3"
                                                      placeholder="Nội dung"><?php echo $data[0]['danhgia']?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group text-right mb-0 mt-5">
                                    <button type="submit" name="them"
                                            class="btn btn-primary waves-effect waves-light mr-1" id='add_product'>Cập nhật
                                    </button>
                                    <a href="{{URL::to('/quantri/nhansu')}}"
                                       clas="btn btn-secondary waves-effect waves-light">Hủy</a>
                                </div>

                            </form>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("files").onchange = function () {

            var ListImages =document.getElementById("files").files;
            if (ListImages.length>0){
                for (let i=0; i< ListImages.length ; i++ ){
                    var filetoload = ListImages[i];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var srcData= e.target.result;
                        var newIMG=document.createElement('img');
                        newIMG.src=srcData;
                        document.getElementById("imageA").innerHTML += newIMG.outerHTML;

                        var xx = document.querySelectorAll('.imageS1');
                        for (i = 0; i < xx.length; i++) {
                            xx[i].style.display = "none";
                        }
                    };
                    //
                    // // read the image file as a data URL.
                    reader.readAsDataURL(filetoload);
                }
            }
        };
    </script>
@endsection
