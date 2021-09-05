
@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="mt-0 header-title">Danh sách ngày làm cơ sở: <span class="btn btn-success">{{ucfirst($nameCs->name)}}</span></h4>
                            <p class="text-muted font-14 mb-3">
                                Ngày làm việc
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
                            <table class="table mb-0 table-bordered table-hover text-center" id="table_product">
                                <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Thứ</th>
                                    <th scope="col" >Số lượng KH</th>
                                    <th scope="col">Giờ bắt đầu</th>
                                    <th scope="col">Giờ kết thúc</th>
                                    <th scope="col">Nghỉ</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col">Xem lịch làm</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($data as $row)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td class="">{{$row->thu}}</td>
                                        <td class="" ><input type="number" name="soluongkh" value="{{$row->soluongkhach}}"></td>
                                        <td class=""><input type="time" id="appt" name="giobatdau"
                                                            min="09:00" max="18:00" value="<?php echo $row->giobatdau;?>" required></td>
                                        <td class=""><input type="time" id="appt" name="giobatdau"
                                                            min="09:00" max="18:00" value="<?php echo $row->gioketthuc;?>" required></td>
                                        <td class=""><input type="checkbox" name="type" <?php if ($row->type==1) echo "checked";?>></td>
                                        <td class=""><input type="text" name="ghichu" value="{{$row->ghichu}}"></td>

                                        <td>
                                            <a href="{{route('lichlamviec.show',$row->id)}}" class="btn btn-success"
                                               role="button"><i class="fa fa-eye"></i></a>
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
