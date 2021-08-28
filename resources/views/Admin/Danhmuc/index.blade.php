@extends('Admin.layoutadmin')

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h2 class="mt-0 header-title">Danh mục </h2>
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
                        <h5>Thêm Nhanh Danh Mục</h5>
                         <form data-parsley-validate action="{{route('danhmuc.store')}}" id="formadd" novalidate onsubmit="return submitForm()" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            
                                <div class="col-lg-4">
                                   
                                    <input type="text" name="name" value="{{old('name')}}"  parsley-trigger="change" required
                                    placeholder="Tên Danh Mục"  class="form-control @error('name') border-error @enderror" >
                                </div>
                                <div class="col-lg-4">
                                    <input type="submit" name="them" class="btn btn-primary waves-effect waves-light mr-1" value="Thêm" id='add_product'>
                                </div>
                            </div>
                         </form>

                        <table class="table mb-0" id="table_product">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5px">STT</th>
                                        <th width="120px">Tên</th>
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
                                            <td>
                                                <form action="{{route('danhmuc.destroy',$row->id)}}"  method="post">
                                                    @csrf
                                                    {!!method_field('delete')!!}
                                                    <button onclick="return confirm('Xoá hả ?');" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            <td>
                                                <a href="{{route('danhmuc.edit',$row->id)}}" class="btn btn-success" role="button"><i class="fa fa-edit"></i></a>
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
