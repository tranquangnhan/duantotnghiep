@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <p class="text-muted font-14 mb-3">
                                <h3 class="btn btn-success">Xem lịch làm việc </h3>
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
                                    <th width="5px">STT</th>
                                    <th width="120px">Tên cơ sở</th>
                                    <th width="5px">Xem lịch làm</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($data as $row)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td class="">{{$row->name}}</td>
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
