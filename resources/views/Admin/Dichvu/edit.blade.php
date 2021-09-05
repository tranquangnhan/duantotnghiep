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
                            <h4 class="header-title mt-0 mb-3 btn btn-success">SỬA DỊCH VỤ</h4>
                            <form data-parsley-validate action="{{route('dichvu.update',$data[0]['id'])}}" id="formadd" role="form"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                {!! method_field('put') !!}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Tên dịch vụ</label><span style="color:red;"> (*)</span>
                                            <input type="text" name="name" value="{{$data[0]['name']}}"
                                                   parsley-trigger="change"
                                                   placeholder="Tên dịch vụ" class="form-control">
                                            @error('name')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giá </label><span style="color:red;"> (*)</span>
                                            <input type="number" name="gia" value="{{$data[0]['gia']}}"
                                                   parsley-trigger="change"
                                                   placeholder="Mức Giá" class="form-control">
                                            @error('gia')
                                            <span class="badge badge-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Mô tả</label>
                                        <textarea name="mota" class="form-control" id="mytextarea" cols="25"
                                                    rows="3"
                                                    placeholder="Mô tả"><?php echo $data[0]['mota']?></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Danh mục</label><span style="color:red;"> (*)</span>
                                            <select class="form-control" name="danhmuc">
                                                @foreach($DanhMuc as $id => $dmkh)
                                                    <option
                                                        value="{{$dmkh->id}}" <?php if ($data[0]['iddm'] == $dmkh->id) echo 'selected';?>>{{$dmkh->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="formFile" class="form-label">Tải ảnh dịch vụ</label>
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
                                                                 src="{{asset('admin/images/dichvu')}}{{'/'.$Anh}}"
                                                                 width="45%"/>
                                                    @endforeach
                                                        <div id="imageA"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-md-12">
                                            <label class="form-label">Nội dung</label>
                                            <textarea name="content" class="form-control" id="mytextarea" cols="25"
                                                      rows="3"
                                                      placeholder="Nội dung"><?php echo $data[0]['content']?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group text-right mb-0 mt-5">
                                    <button type="submit" name="them"
                                            class="btn btn-primary waves-effect waves-light mr-1" id='add_product'>Cập nhật
                                    </button>
                                    <a href="{{URL::to('/quantri/dichvu')}}"
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
