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
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5px">STT</th>
                                        <th width="120px">Tên</th>
                                        <th width="120px">Tỉnh/Thành phố</th>
                                        <th width="120px">Quận/Huyện</th>
                                        <th width="120px">Địa chỉ</th>
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
                                            <td class="" >{{$row->name}}</td>
                                            <td class="" >{{$row->city->name_city}}</td>
                                            <td class="" >{{$row->province->name_quanhuyen}}</td>
                                            <td class="" >{{$row->wards->name_xaphuong}}</td>
                                            <td>

                                            <form action="{{route('coso.destroy',$row->id)}}"  method="post">
                                                    @csrf
                                                    {!!method_field('delete')!!}
                                                    <button onclick="return confirm('Xoá hả ?');" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            <td>
                                                <a href="{{route('coso.edit',$row->id)}}" class="btn btn-success edit_coso" role="button"><i class="fa fa-edit"></i></a>
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
