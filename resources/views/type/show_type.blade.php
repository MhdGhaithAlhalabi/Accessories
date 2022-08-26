@extends('product.product')

@section('title')
    عرض الانواع
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('page_name')
    عرض الانواع
@endsection

@section('second_directory')
    عرض الانواع
@endsection

@section('first_directory')
    المنتجات
@endsection

@section('type')

    <div class="container">
            <div class="card card-primary" style="direction: rtl">
                <div class="card-header">
                    <h3 class="card-title">اضافة انواع واصناف</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
<div class="row">

    <div class="col-sm-6 d-flex">
            <div class="card card-warning" style="direction: rtl;margin-block: 2px">
                <div class="card-header">
                    <h3 class="card-title">اضافة انواع </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
            <form action="{{route('type.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="type_name">الاسم</label>
                    <label>
                        <input type="text" name="type_name" class="form-control" placeholder="الاسم">
                    </label>
                    @if($errors->has('type_name'))
                        <div class="alert alert-danger">{{ $errors->first('type_name') }}</div>
                    @endif
                </div>
                  {{--  <div class="form-group">
                        <label for="type_image">الصورة</label>
                        <label>
                            <input type="text" name="type_image" class="form-control" placeholder="الصورة">
                        </label>
                        @if($errors->has('type_image'))
                            <div class="alert alert-danger">{{ $errors->first('type_image') }}</div>
                        @endif
                </div>--}}
                <button type="submit" style="margin-block: 2px" class="btn btn-success btn-block">موافق</button>
            </form>

    </div>
            </div>
        </div>

    <div class="col-sm-6 d-flex">
            <div class="card card-warning" style="direction: rtl;margin-block: 2px">
                <div class="card-header">
                    <h3 class="card-title">اضافة اصناف</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="category_name">الاسم</label>
                    <label>
                        <input type="text" name="category_name" class="form-control" placeholder="الاسم">
                    </label>
                    @if($errors->has('category_name'))
                        <div class="alert alert-danger">{{ $errors->first('category_name') }}</div>
                    @endif
                </div>
                    <div class="form-group">
                        <label for="category_image">الصورة</label>
                        <label>
                            <input type="text" name="category_image" class="form-control" placeholder="الصورة">
                        </label>
                        @if($errors->has('category_image'))
                            <div class="alert alert-danger">{{ $errors->first('category_image') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="type_id">النوع</label>
                        <label>
                            <select class="form-control" name="type_id" aria-label="Default select example">
                                @foreach($types as $type)
                                    <option  value="{{$type->id}}">{{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </label>
                        @if($errors->has('type_id'))
                            <div class="alert alert-danger">{{ $errors->first('type_id') }}</div>
                        @endif
                    </div>


                <button type="submit" style="margin-block: 2px" class="btn btn-success btn-block">موافق</button>
            </form>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>


    <div class="container">

        <div class="card card-primary" style="direction: rtl">
        <div class="card-header" >
            <h3 class="card-title">الانواع</h3>
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
                              {{--  <th>الصورة</th>--}}
                                <th>التعديلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($types as $type )
                                <tr>
                                    <th>{{++$i}}</th>
                                    <td>{{$type->type_name}}</td>
                                   {{-- <td>
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" style="border-radius: 10px;display: block;margin-left: auto;margin-right: auto" src="{{$type->type_image}}" alt="Card image cap">
                                        </div>
                                    </td>--}}


                                    <td>
                                        <div class="row">
                                            <div class="col-sm">
                                                <a class="btn btn-success btn-block" style="margin-block: 2px" href="{{route('type.edit' ,$type->id)}}"> التعديل</a>
                                            </div>

                                            <div class="col-sm">
                                                <form  action="{{ route('type.delete' , $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
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
                        <th>الاسم</th>
                   {{--     <th>الصورة</th>--}}
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
                <h3 class="card-title">الاصناف</h3>
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
                                    <th scope="col">الصورة</th>
                                    <th scope="col">التعديلات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($categories as $category )
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->type->type_name}}</td>
                                        <td>
                                            <div class="card" style="width: 18rem;">
                                                <img class="card-img-top" style="border-radius: 10px;display: block;margin-left: auto;margin-right: auto" src="{{$category->category_image}}" alt="Card image cap">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm">
                                                <a class="btn btn-success btn-block" style="margin-block: 2px" href="{{route('category.edit' ,$category->id)}}"> التعديل</a>
                                                </div>
                                                    <div class="col-sm">
                                                        <form  action="{{ route('category.delete' , $category->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
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
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">الصورة</th>
                                    <th scope="col">التعديلات</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
        </div>
</div>






            <!-- /.card-body -->

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


