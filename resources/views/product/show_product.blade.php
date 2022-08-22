@extends('product.product')

@section('title')
عرض المنتجات
@endsection
@section('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endsection
@section('page_name')
    عرض المنتجات
@endsection

@section('second_directory')
    عرض المنتجات
@endsection

@section('first_directory')
المنتجات
@endsection

@section('type')
    <div class="card card-primary" style="direction: rtl">
        <div class="card-header">
            <h3 class="card-title">المنتجات</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">التفاصيل</th>
                                <th scope="col">السعر</th>
                                <th scope="col">العرض</th>
                                <th scope="col">السعر بعد العرض</th>
                                <th scope="col">التقييم</th>
                                <th scope="col">النوع</th>
                                <th scope="col">الصنف</th>
                                <th scope="col">الالوان</th>
                                <th scope="col">الصور</th>
                                <th scope="col">التعديلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($products as $product )
                                <tr>
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->details}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>{{$product->priceSale}}</td>
                                    <td>{{$product->rate}}</td>
                                    <td>{{$product->type->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>
                                        @foreach($product->color as $color)
                                            <div class="row">
                                                {{$color->color}}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($product->image as $image)
                                            <div class="card" style="width: 18rem;">
                                                <img src="/storage/cover_images/{{ $image->url }}" >
                                            </div>
                                        @endforeach
                                        <br>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm">
                                                <a class="btn btn-primary btn-block" style="margin-block: 2px" href="{{route('product.edit' ,$product->id)}}"> التعديل</a>
                                            </div>

                                            <div class="col-sm">
                                                <form  action="{{ route('product.delete' , $product->id) }}" method="POST">
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
                                <th scope="col">التفاصيل</th>
                                <th scope="col">السعر</th>
                                <th scope="col">العرض</th>
                                <th scope="col">السعر بعد العرض</th>
                                <th scope="col">التقييم</th>
                                <th scope="col">النوع</th>
                                <th scope="col">الصنف</th>
                                <th scope="col">الالوان</th>
                                <th scope="col">الصور</th>
                                <th scope="col">التعديلات</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
