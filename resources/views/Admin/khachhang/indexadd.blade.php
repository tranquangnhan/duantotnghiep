@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container">

                <form data-parsley-validate action="{{route('khachhang.store')}}" id="formadd"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Tên Khách hàng</label><span style="color:red;"> (*)</span>
                                <input type="text" name="name" value="{{old('name')}}"  parsley-trigger="change"
                                       placeholder="Tên Khách hàng"  class="form-control" >
                                @error('name')
                                <span class="badge badge-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Số điện thoại</label><span style="color:red;"> (*)</span>
                                <input type="number" name="sdt" value="{{old('sdt')}}"  parsley-trigger="change"
                                       placeholder="Số điện thoại"  class="form-control" >
                                @error('sdt')
                                <span class="badge badge-danger">{{$message}}</span>
                                @enderror
                            </div>                            
                        </div>
                        <div class="form-group text-left col-3 mt-3">
                            <label for=""></label>
                            <button type="submit" name="them" class="btn btn-primary waves-effect waves-light mr-1"  id='add_product'>Thêm</button>
                        </div>
                    </div>
                </form>

                <table class="table mb-0 table-bordered table-hover" id="table_product">
                    <thead class="thead-light text-center">
                    <tr>
                        <th width="5px">STT</th>
                        <th width="30%">Tên khách hàng</th>
                        <th width="30%">Số điện thoại</th>
                        <th width="35px">Xóa</th>
                        <th width="35px">Sửa</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $i=> $row)
                        <tr>
                            <td>{{$i+=1}}</td>
                            <td class="">
                                {{$row->name}} <br>
                            </td>
                           
                           
                            <td width="30%">
                                 {{$row->sdt}}
                            </td>
                            <td>
                                <form action="{{route('khachhang.destroy',$row->id)}}" method="post">
                                    @csrf
                                    {!!method_field('delete')!!}
                                    <button onclick="return confirm('Bạn muốn xóa chứ ?');" type="submit"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            <td>
                                <a href="{{route('khachhang.edit',$row->id)}}" class="btn btn-success"
                                   role="button"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row d-flex justify-content-end">
                    <div class="col-lg-5">
                        <nav>
                            <ul class="pagination pagination-split">

                            </ul>
                        </nav>

                    </div>
                </div>


            </div> <!-- container-fluid -->

        </div> <!-- content -->


    </div>
    @if (session('thanhcong'))
        <script>
            iziToast.success({
                title: 'Thành công',
                message: '<?php echo session('thanhcong');?>',
                position: 'topRight',
                backgroundColor:  'green',
                titleColor: 'white',
                messageColor: 'white',
                iconColor: 'white',
            });
        </script>
    @elseif(session('thatbai'))
        <script>
            iziToast.success({
                title: 'Thất bại',
                message: '<?php echo session('thatbai');?>',
                position: 'topRight',
                backgroundColor: 'orange',
                titleColor: 'white',
                messageColor: 'white',
                iconColor: 'white',
            });
        </script>
    @endif
@endsection
