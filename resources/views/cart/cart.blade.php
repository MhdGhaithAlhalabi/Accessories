@extends('layouts.master')

@section('title')
    الطلبات
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                <div class="card-header" >
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
                                        <th>المنتجات المطلوبة</th>
                                        <th>العنوان</th>
                                        <th>السعر الكلي</th>
                                        <th>وقت الطلب</th>
                                        <th>التعديلات</th>
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
                                            <td>
                                                @foreach($cart->order as $order)
                                                    <div class="row">
                                                        اسم المنتج:
                                                        {{ $order->product->name }}
                                                    </div>
                                                    <div class="row">
                                                       السعر:
                                                        {{ $order->product->price }}
                                                    </div>
                                                    <div class="row">
                                                        حالة العرض:
                                                        @if($order->product->status == 0)
                                                            لا يوجد عرض
                                                        @endif
                                                        @if($order->product->status == 1)
                                                             يوجد عرض
                                                        @endif
                                                    </div>
                                                    <div class="row">
                                                        السعر بعد العرض:
                                                        @if($order->product->priceSale == null)
                                                            لا يوجد سعر عرض
                                                        @endif
                                                        {{ $order->product->priceSale }}
                                                    </div>
                                                    <div class="row">
                                                        الكمية:
                                                        {{$order->qty}}
                                                    </div>
                                                    <div class="row">
                                                        اللون:
                                                        {{$order->color}}
                                                    </div>
                                                    <div class="row">
                                                        الاسماء:
                                                        @if($order->has_name == null)
                                                            لا يوجد اسم
                                                            @endif
                                                        {{$order->has_name}}
                                                    </div>
                                                    <div class="row">
                                                        القياس:
                                                        @if($order->has_measure == null)
                                                            لا يوجد قياس
                                                        @endif
                                                        {{$order->has_measure}}
                                                    </div>
                                     <hr>
                                                    @endforeach
                                            </td>
                                            <td>{{$cart->address}} </td>
                                            <td>{{$cart->amount}}</td>
                                            <td>{{$cart->created_at}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <form  action="{{route('cart.done',$cart->id)}}" method="POST">
                                                            @csrf
                                                            @method('post')
                                                            <button type="submit" style="margin-block: 2px" class="btn btn-success btn-block">جاهزة</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-sm">
                                                        <form  action="{{route('cart.delete',$cart->id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="margin-block: 2px" class="btn btn-danger btn-block">حذف</button>
                                                        </form>
                                                    </div>

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
                                        <th>المنتجات المطلوبة</th>
                                        <th>العنوان</th>
                                        <th>السعر الكلي</th>
                                        <th>وقت الطلب</th>
                                        <th>التعديلات</th>
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
        <div class="card-header" >
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
                                <th>المنتجات المطلوبة</th>
                                <th>العنوان</th>
                                <th>السعر الكلي</th>
                                <th>وقت الطلب</th>
                                <th>حذف</th>
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
                                    <td>
                                        @foreach($cart->order as $order)
                                            <div class="row">
                                                اسم المنتج:
                                                {{ $order->product->name }}
                                            </div>
                                            <div class="row">
                                                السعر:
                                                {{ $order->product->price }}
                                            </div>
                                            <div class="row">
                                                حالة العرض:
                                                @if($order->product->status == 0)
                                                    لا يوجد عرض
                                                @endif
                                                {{ $order->product->status }}
                                            </div>
                                            <div class="row">
                                                حالة العرض:
                                                @if($order->product->priceSale == null)
                                                    لا يوجد سعر عرض
                                                @endif
                                                {{ $order->product->priceSale }}
                                            </div>
                                            <div class="row">
                                                الكمية:
                                                {{$order->qty}}
                                            </div>
                                            <div class="row">
                                                اللون:
                                                {{$order->color}}
                                            </div>
                                            <div class="row">
                                                الاسماء:
                                                @if($order->has_name == null)
                                                    لا يوجد اسم
                                                @endif
                                                {{$order->has_name}}
                                            </div>
                                            <div class="row">
                                                القياس:
                                                @if($order->has_measure == null)
                                                    لا يوجد قياس
                                                @endif
                                                {{$order->has_measure}}
                                            </div>
                                            <hr>
                                        @endforeach
                                    </td>
                                    <td>{{$cart->address}} </td>
                                    <td>{{$cart->amount}}</td>
                                    <td>{{$cart->created_at}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm">
                                                <form  action="{{route('cart.delete',$cart->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" style="margin-block: 2px" class="btn btn-danger btn-block">حذف</button>
                                                </form>
                                            </div>

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
                                <th>المنتجات المطلوبة</th>
                                <th>العنوان</th>
                                <th>السعر الكلي</th>
                                <th>وقت الطلب</th>
                                <th>حذف</th>
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
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>
    <script>
        $(document).ready( function () {
            $('#example2').DataTable();
        } );
    </script>

@endsection



