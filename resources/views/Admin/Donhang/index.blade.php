@extends('Admin.layoutadmin')

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="mt-0 header-title">Danh mục </h4>
                        <p class="text-muted font-14 mb-3">
                       Đây là danh mục
                        </p>
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{Session::get('success')}}</p>
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger">
                                <p>{{Session::get('error')}}</p>
                            </div>
                        @endif
                        <table class="table mb-0" id="table_product">
                                <thead class="thead-light" style="text-align: center;">
                                    <tr>
                                        <th width="5px">STT</th>
                                        <th width="140px">Tên khách hàng</th>
                                        <th width="100px">Tên cơ sở</th>
                                        <th width="140px">Tên nhân viên</th>
                                        <th width="140px">Tổng tiền</th>
                                        <th width="120px">Mã giảm giá</th>
                                        <th width="140px">Tổng đã giảm</th>
                                        <th width="160px">Ghi chú</th>
                                        <th width="5px">Xóa</th>
                                        <th width="5px">Sửa</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($data as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td class="" >{{$row->idkh}}</td>
                                            <td class="" >{{$row->idcs}}</td>
                                            <td class="" >{{$row->nhanvien}}</td>
                                            <td class="" >{{ number_format($row->tongtien) }} VNĐ</td>
                                            <td class="" >{{$row->magg}}</td>
                                            <td class="" >{{ number_format($row->tongtiengg) }} VNĐ</td>
                                            <td class="" >{{$row->ghichu}}</td>

                                            <td>

                                            <form action="{{route('donhang.destroy',$row->iddh)}}"  method="post">
                                                    @csrf
                                                    {!!method_field('delete')!!}
                                                    <button onclick="return confirm('Xoá hả ?');" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            <td>
                                                <a href="{{route('donhang.edit',$row->iddh)}}" class="btn btn-success edit_donhang" role="button"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <!-- end row -->
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
@endsection
