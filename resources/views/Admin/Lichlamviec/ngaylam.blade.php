
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

                            <a href="{{url("/quantri/lichlamviec")}}" class="btn btn-danger mb-2">Quay lại</a>
                            <table class="table mb-0 table-bordered table-hover text-center" id="">
                                <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Thứ</th>
                                    <th scope="col" >Số lượng KH</th>
                                    <th scope="col">Giờ bắt đầu</th>
                                    <th scope="col">Giờ kết thúc</th>
                                    <th scope="col">Nghỉ</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col">Cập nhật</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($data as $row)
                               <form action="{{route('lichlamviec.update',$row->id)}}" method="post">
                                   @csrf
                                   {!! method_field('patch') !!}
                                    <tr>
                                        <input type="hidden" name="idcoso" value="{{$row->idcoso}}">

                                        <td>{{$i+=1}}</td>
                                        <td class="">{{$row->thu}}</td>
                                        <td class="" ><input type="number" name="soluongkh" min="1" max="150" value="{{$row->soluongkhach}}"></td>
                                        <td class=""><input type="time" id="appt" name="giobatdau"
                                                            min="06:45" max="18:00" value="<?php echo date_format(date_create($row->giobatdau), "H:s");?>" required></td>
                                        <td class=""><input type="time" id="appt" name="gioketthuc"
                                                            min="09:00" max="18:00" value="<?php echo date_format(date_create($row->gioketthuc), "H:s");?>" required></td>
                                        <td class=""><input type="checkbox" name="type"  <?php if ($row->type==1) echo "checked";?>></td>
                                        <td class=""><input type="text" name="ghichu" value="{{$row->ghichu}}"></td>

                                        <td>
                                            <button type="submit" name="capnhat" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                               </form>
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
