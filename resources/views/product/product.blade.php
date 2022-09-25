@extends('layouts.master')

@section('title')
المنتجات
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
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link glightbox" data-glightbox="type: external" title="انشاء منتج"  href="{{route('product.create')}}">
                        <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>
                        <p> انشاء منتج </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link glightbox" data-glightbox="type: external" title="انشاء نوع"  href="{{route('type.create')}}">
                        <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>
                        <p> انشاء نوع </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link glightbox" data-glightbox="type: external" title="انشاء صنف"  href="{{route('category.create')}}">
                        <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>
                        <p> انشاء صنف </p>
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    @yield('type')

@endsection


