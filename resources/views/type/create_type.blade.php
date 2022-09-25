<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>انشاء نوع</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

</head>
<body>


    <div class="card card-primary" style="direction: rtl">
        <div class="card-header">
            <h3 class="card-title">اضافة نوع</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row">


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


<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
</body>
</html>






