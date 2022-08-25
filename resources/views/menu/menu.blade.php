@extends('layouts.master')

@section('title')
    المنتجات اليومية
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('page_name')
    المنتجات اليومية
@endsection

@section('second_directory')
     المنتجات اليومية
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
    @if($errors->has('product_id'))
        <div class="alert alert-danger">{{ $errors->first('product_id') }}</div>
    @endif
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="container">

            <div class="card card-primary" style="direction: rtl">
                <div class="card-header" >
                    <h3 class="card-title">المنتجات</h3>
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
                                        <th>الاسم</th>
                                        <th>النوع</th>
                                        <th>الصنف</th>
                                        <th>اضافة الى القائمة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($products as $product )
                                        <tr>
                                            <th>{{++$i}}</th>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->type->type_name}}</td>
                                            <td>{{$product->category->category_name}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <form  action="{{ route('menu.store') }}" method="POST">
                                                            @csrf
                                                            @method('post')
                                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                                            <button type="submit" style="margin-block: 2px" class="btn btn-success btn-block">اضافة الى القائمة</button>
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
                                        <th>الاسم</th>
                                        <th>النوع</th>
                                        <th>الصنف</th>
                                        <th>اضافة الى القائمة</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="container">
            <div class="card card-primary" style="direction: rtl">
                <div class="card-header" >
                    <h3 class="card-title">القائمة اليومية</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 d-flex">
                            <div class="table-responsive-sm table-responsive-md">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr role="row">
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">النوع</th>
                                        <th scope="col">الصنف</th>
                                        <th scope="col">ازالة من القائمة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($menus as $menu )
                                        <tr>
                                            <th>{{++$i}}</th>
                                            <td>{{$menu->name}}</td>
                                            <td>{{$menu->type->type_name}}</td>
                                            <td>{{$menu->category->category_name}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <form  action="{{ route('menu.delete' , $menu->menu->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="margin-block: 2px" class="btn btn-danger btn-block">ازالة من القائمة</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">النوع</th>
                                        <th scope="col">الصنف</th>
                                        <th scope="col">ازالة من القائمة</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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



