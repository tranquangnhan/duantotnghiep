@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container">
                <a href="{{route('dichvu.create')}}" class="btn btn-success">Thêm dịch vụ</a>
                <table class="table mb-0 table-bordered table-hover" id="table_product">
                    <thead class="thead-light">
                    <tr>
                        <th width="5px">STT</th>
                        <th width="25%">Tên DV</th>
                        <th width="15%">Hình ảnh</th>
                        <th width="20px">Danh mục</th>
                        <th width="30px">Mô tả</th>
                        <th width="30px">Giá</th>
                        <th width="5px">Xóa</th>
                        <th width="5px">Sửa</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $i=> $row)
                        <tr>
                            <td>{{$i+=1}}</td>
                            <td class="">
                                {{$row->name}} 
                            </td>
                            <td width="15%" class="text-center">
                                <img class="" width="90" src="{{asset("admin/images/dichvu")}}{{'/'.$row->img}}">
                            </td>
                            <td>
                               {{$row->name}}

                            </td>
                            <td>
                                {{$row->mota}}
 
                             </td>
                            <td width="20%">
                                {{number_format($row->gia), ''}} VND
                            </td>
                            <td>
                                <form action="{{route('dichvu.destroy',$row->id)}}" method="post">
                                    @csrf
                                    {!!method_field('delete')!!}
                                    <button onclick="return confirm('Bạn muốn xóa chứ ?');" type="submit"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            <td>
                                <a href="{{route('dichvu.edit',$row->id)}}" class="btn btn-success"
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
