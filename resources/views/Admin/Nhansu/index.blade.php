@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container">
                <a href="{{route('nhansu.create')}}" class="btn btn-success">Thêm nhân sự</a>
                <table class="table mb-0 table-bordered table-hover" id="table_product">
                    <thead class="thead-light text-center">
                    <tr>
                        <th width="5px">STT</th>
                        <th width="25%">Thông tin</th>
                        <th width="15%">Avatar</th>
                        <th width="20px">Thông tin khác</th>
                        <th width="30px">Chức vụ</th>
                        <th width="5px">Xóa</th>
                        <th width="5px">Sửa</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $i=> $row)
                        <tr>
                            <td>{{$i+=1}}</td>
                            <td class="">
                                <strong>Tên:</strong> {{$row->name}} <br>
                                <strong>Email:</strong> {{$row->email}} <br>
                                <strong>Năm sinh:</strong> {{$row->namsinh}} <br>
                                <strong>Giới tính:</strong> <?php echo ($row->gioitinh == 0) ? "Nam" : "Nữ";?>
                            </td>
                            <td width="15%" class="text-center">
                                <?php $img= explode(",", $row->img);
                                ?>
                                @foreach($img as $idAnh => $Anh)
                                        <img class="mb-2" width="90" src="{{asset("admin/images/users")}}{{'/'.$Anh}}">
                                    @endforeach
                            </td>
                            <td>
                                <?php echo ($row->role == 1) ? "ADMIN" : "Nhân viên";?>
                                <br>
                                <strong>Dịch vụ: </strong> {{$row->tendv}}
                                <br>
                                <strong>Đánh giá: </strong> {{$row->danhgia}}
                            </td>
                            <td width="20%">
                                <strong>Chức vụ: </strong> {{$row->chucvu}}
                                <br>
                                <strong>Lương: </strong> {{number_format($row->luong), ''}} VND
                            </td>
                            <td>
                                <form action="{{route('nhansu.destroy',$row->id)}}" method="post">
                                    @csrf
                                    {!!method_field('delete')!!}
                                    <button onclick="return confirm('Bạn muốn xóa chứ ?');" type="submit"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            <td>
                                <a href="{{route('nhansu.edit',$row->id)}}" class="btn btn-success"
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
