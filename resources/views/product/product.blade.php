@extends('layouts.master')

@section('title')
المنتجات
@endsection

@section('css')
@endsection

@section('page_name')
    المنتجات
@endsection

@section('second_directory')
    المنتجات
@endsection

@section('first_directory')
لوحة التحكم
@endsection

@section('content')

    <nav class="navbar navbar-light bg-faded navbar-expand justify-content-between flex-nowrap flex-row navbar-expand-sm bg-light justify-content-center">
        <div class="container-fluid">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link {{'productView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('product.index')}}">عرض المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'productView2'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('product.index2')}}">الالوان والصور</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'productCreate'== request()->path() ? 'active' : ''}}" aria-current="page" href="{{route('product.create')}}">إنشاء منتج</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'typeView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('type.index')}}">الانواع والاصناف</a>
                    </li>

                </ul>

        </div>
    </nav>
    @yield('type')


@endsection

@section('script')
@endsection
