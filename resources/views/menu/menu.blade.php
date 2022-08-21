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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">المنتجات اليومية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">المنتجات</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('menu')

@endsection

@section('script')
@endsection
