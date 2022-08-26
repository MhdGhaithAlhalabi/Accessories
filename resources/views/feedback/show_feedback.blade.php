@extends('feedback.feedback')

@section('title')
    الرسائل الجديدة
@endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('page_name')
    الرسائل الجديدة
@endsection

@section('second_directory')
    الرسائل الجديدة
@endsection

@section('first_directory')
    رسائل التواصل
@endsection

@section('feedback')
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
                <h3 class="card-title">الرسائل الجديدة</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>رقم الموبايل</th>
                            <th>المدينة</th>
                            <th>الرسالة</th>
                            <th>التاريخ</th>
                            <th>تعيين كمقروء</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($feedbacks as $feedback )
                            <tr>
                                <th>{{++$i}}</th>
                                <td>{{$feedback->customer->name}}</td>
                                <td>{{$feedback->customer->phone}}</td>
                                <td>{{$feedback->customer->city}}</td>
                                <td>{{$feedback->message}}</td>
                                <td>{{$feedback->created_at}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm">
                                            <form  action="{{ route('feedback.read' , $feedback->id) }}" method="POST">
                                                @csrf
                                                @method('post')
                                                <button type="submit" style="margin-block: 2px" class="btn btn-danger btn-block">قراءة</button>
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
                            <th>رقم الموبايل</th>
                            <th>الرسالة</th>
                            <th>التاريخ</th>
                            <th>تعيين كمقروء</th>
                        </tr>
                        </tfoot>
                    </table>
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
