@extends('Admin.layoutadmin')

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="mt-0 header-title">Chấm Công </h4>
                        <p class="text-muted font-14 mb-3">
                            Quản lí chấm công
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
                                        <th width="120px">Tên Nhân Sự</th>
                                        <th width="120px">Ngày</th>
                                        <th width="120px">Check in</th>
                                        <th width="120px">Check out</th>
                                        <th width="120px">Trạng thái</th>
                                        <th width="5px">Xóa</th>
                                        <th width="5px">Sửa</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="" >{{$row->idns}}</td>
                                            <td class="" >{{$row->Ngay}}</td>
                                            <td class="" >{{$row->checkin}}</td>
                                            <td class="" >{{$row->checkout}}</td>
                                            <td class="" >{{$row->trangthai}}</td>
                                            <td>
                                                <form method="post">
                                                    @csrf
                                                    {!!method_field('delete')!!}
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                    <button type="button" class="btn btn-danger delete-btn" delete-id="{{ $row->id }}" delete-route="chamcong" ><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>

                                            <td>
                                                <a href="{{route('chamcong.edit',$row->id)}}" class="btn btn-success" role="button"><i class="fa fa-edit"></i></a>
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

