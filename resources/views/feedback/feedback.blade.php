@extends('layouts.master')

@section('title')
    رسائل التواصل
@endsection

@section('css')
@endsection

@section('page_name')
    رسائل التواصل
@endsection

@section('second_directory')
    رسائل التواصل
@endsection

@section('first_directory')
    لوحة التحكم
@endsection

@section('content')

    <nav class="navbar navbar-light bg-faded navbar-expand justify-content-between flex-nowrap flex-row navbar-expand-sm bg-light justify-content-center">
        <div class="container-fluid">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link {{'feedbackView'== request()->path() ? 'active' :  ''}}" aria-current="page" href="{{route('feedbackView.index')}}">
                        <i class="nav-icon fas fa-paper-plane" aria-hidden="true"></i>
                    <p>
                        الرسائل الجديدة
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{'feedbackReadView'== request()->path() ? 'active' : ''}}" aria-current="page" href="{{route('feedbackReadView.index')}}">
                        <i class="nav-icon fas fa-book-reader" aria-hidden="true"></i>

                        <p>
                        الرسائل المقروءة
                        </p>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
    @yield('feedback')

@endsection

@section('script')
@endsection
