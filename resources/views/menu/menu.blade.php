@extends('layouts.master')

@section('title')
    المنتجات اليومية
@endsection

@section('css')
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


    <div class="container">

        <div class="card card-primary" style="direction: rtl">
            <div class="card-header" >
                <h3 class="card-title">المنتجات</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 d-flex">
                        <div class="table-responsive-sm">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>النوع</th>
                                    <th>الصنف</th>
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
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>النوع</th>
                                    <th>الصنف</th>
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
                <h3 class="card-title">القائمة اليومية</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6 d-flex">
                        <div class="table-responsive-sm">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr role="row">
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col">الصنف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($menus as $menu )
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$menu->product->name}}</td>
                                        <td>{{$menu->product->type->type_name}}</td>
                                        <td>{{$menu->product->type->type_name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col">الصنف</th>
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
@endsection
