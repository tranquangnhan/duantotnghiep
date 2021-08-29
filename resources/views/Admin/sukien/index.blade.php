@extends('Admin.layoutadmin')

@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="mt-0 header-title">Book Lịch </h4>
                            <p class="text-muted font-14 mb-3">
                                Tùy chọn sự kiện cá nhân/tập thể
                            </p>
                            <div id="calendar"></div>
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

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.css">
{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}
    <script src="{{ asset('admin/js') }}/long_sukien.js"></script>
@endsection
