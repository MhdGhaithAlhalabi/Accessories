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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{'productView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('product.index')}}">عرض المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'productView2'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('product.index2')}}">اضافة خصائص للمنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'productCreate'== request()->path() ? 'active' : ''}}" aria-current="page" href="{{route('product.create')}}">انشاء منتج</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'typeCreate'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('type.create')}}">انشاء نوع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'typeView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('type.index')}}">عرض الانواع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'categoryView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('category.index')}}">عرض الاصناف</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'categoryCreate'== request()->path() ? 'active' : ''}}" aria-current="page" href="{{route('category.create')}}">انشاء صنف</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('type')


@endsection

@section('script')
@endsection
