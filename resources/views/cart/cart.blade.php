@extends('layouts.master')


@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('title')
    الطلبات
@endsection


@section('page_name')
    الطلبات
@endsection

@section('second_directory')
    الطلبات
@endsection

@section('first_directory')
    لوحة التحكم
@endsection

@section('content')

    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if($errors->has('id'))
            <div class="alert alert-danger">{{ $errors->first('id') }}</div>
        @endif
    </div>

    <div class="container">
        <div class="card card-primary" style="direction: rtl">
            <div class="card-header">
                <h3 class="card-title">الطلبات المنتظرة</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 d-flex">
                        <div class="table-responsive-sm table-responsive-md">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم الهاتف</th>
                                    <th>المدينة</th>
                                    <th>العنوان</th>
                                    <th>السعر الكلي</th>
                                    <th>وقت الطلب</th>
                                    <th>عرض الطلب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($carts as $cart )
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$cart->customer->name}}</td>
                                        <td>{{$cart->customer->phone}}</td>
                                        <td>{{$cart->customer->city}}</td>
                                        <td>{{$cart->address}} </td>
                                        <td>{{$cart->amount}}</td>
                                        <td>{{$cart->created_at}}</td>
                                        <td>
                                            <div class="row">

                                                <a class="btn btn-success btn-block glightbox" style="margin-block: 2px"
                                                   data-glightbox="type: external" title="انشاء نوع"
                                                   href="{{route('cart.cartView',$cart->id)}}">
                                                    <p> عرض التفاصيل </p>
                                                </a>

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم الهاتف</th>
                                    <th>المدينة</th>
                                    <th>العنوان</th>
                                    <th>السعر الكلي</th>
                                    <th>وقت الطلب</th>
                                    <th>عرض الطلب</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card card-primary" style="direction: rtl">
            <div class="card-header">
                <h3 class="card-title">الطلبات المنتهية</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 d-flex">
                        <div class="table-responsive-sm table-responsive-md">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم الهاتف</th>
                                    <th>المدينة</th>
                                    <th>العنوان</th>
                                    <th>السعر الكلي</th>
                                    <th>وقت الطلب</th>
                                    <th>عرض الطلب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($carts2 as $cart )
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$cart->customer->name}}</td>
                                        <td>{{$cart->customer->phone}}</td>
                                        <td>{{$cart->customer->city}}</td>
                                        <td>{{$cart->address}} </td>
                                        <td>{{$cart->amount}}</td>
                                        <td>{{$cart->created_at}}</td>
                                        <td>
                                            <div class="row">

                                                <a class="btn btn-success btn-block glightbox" style="margin-block: 2px"
                                                   data-glightbox="type: external" title="انشاء نوع"
                                                   href="{{route('cart.cartView',$cart->id)}}">
                                                    <p> عرض التفاصيل </p>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم الهاتف</th>
                                    <th>المدينة</th>
                                    <th>العنوان</th>
                                    <th>السعر الكلي</th>
                                    <th>وقت الطلب</th>
                                    <th>عرض الطلب</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script>
        lightbox.on('close', () => {
            location.reload();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
            });
        });
    </script>

@endsection



