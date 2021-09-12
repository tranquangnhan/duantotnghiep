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
                            <h4 class="header-title mt-0 mb-3 btn btn-success">SỬA THÔNG TIN KHÁCH HÀNG</h4>
                            <form data-parsley-validate action="{{route('khachhang.update',$data[0]['id'])}}" id="formadd" role="form"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                {!! method_field('patch') !!}
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Tên Khách hàng</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="name" value="{{$data[0]['name']}}"  parsley-trigger="change"
                                                   placeholder="Tên Khách hàng"  class="form-control" >
                                            @error('name')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Số điện thoại</label><span style="color:red;"> (*)</span>
                                            <input type="number" name="sdt" value="{{$data[0]['sdt']}}"  parsley-trigger="change"
                                                   placeholder="Số điện thoại"  class="form-control" >
                                            @error('sdt')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>                            
                                    </div>
                                </div>

                                <div class="form-group text-right mb-0 mt-5">
                                    <button type="submit" name="them"
                                            class="btn btn-primary waves-effect waves-light mr-1" id='add_product'>Cập nhật
                                    </button>
                                    <a href="{{URL::to('/quantri/khachhang')}}"
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
