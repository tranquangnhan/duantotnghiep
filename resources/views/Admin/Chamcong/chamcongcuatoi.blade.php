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
                            Chấm công của tôi
                        </p>
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p class="m-0">{{Session::get('success')}}</p>
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger">
                                <p class="m-0">{{Session::get('error')}}</p>
                            </div>
                        @endif
                        <div class="control_">
                            <a href="/quantri/chamcong/create" class="btn btn-primary" style="color: white;">Chấm công</a>
                            <a href="/quantri/xinnghi" class="btn btn-warning" style="color: white;">Xin nghỉ</a>
                        </div>
                        <table class="table mb-0" id="table_product">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5px">STT</th>
                                        <th width="120px">Tên Nhân Sự</th>
                                        <th width="120px">Ngày</th>
                                        <th width="120px">Check in</th>
                                        <th width="120px">Check out</th>
                                        <th width="50px">Trạng thái</th>
                                        <th width="5px">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listChamCong as $row)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="" >{{$row->nhansu->name}}</td>
                                            <td class="" >{{ date('d-m-Y', strtotime($row->ngay)) }}</td>
                                            <td class="" >{{ date("H:i:s", $row->checkin) }}</td>
                                            <td class="" >
                                                @php
                                                    echo ($row->checkout != '') ? date('H:i:s', $row->checkout) : '';
                                                @endphp</td>
                                            <td class="" >
                                                <div class="alert alert-{{ $row->class }} text-center" style="padding: 6px" role="alert">
                                                    {{$row->tenTrangThai}}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($row->delete == true)
                                                    <form method="post">
                                                        @csrf
                                                        {!!method_field('delete')!!}
                                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                                        <button type="button" class="btn btn-danger delete-btn" delete-id="{{ $row->id }}" delete-route="chamcong" ><i class="fa fa-trash"></i></button>
                                                        {{-- <button type="submit">Xoa</button> --}}
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-dark" style="cursor: context-menu"><i class="fa fa-trash"></i></button>
                                                @endif
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

