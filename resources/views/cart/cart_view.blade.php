<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>create product</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body>
    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">معلومات الزبون</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p> الاسم:  {{$cart->customer->name}} </p>
                    <p>  رقم الهاتف: {{$cart->customer->phone}}  </p>
                    <p>  المدينة: {{$cart->customer->city}}  </p>
                    <p>  العنوان: {{$cart->address}}  </p>
                    <p>  قيمة الفاتورة: {{$cart->amount}}  </p>
                    <p> حالة الطلب: @if($cart->status == 'waiting')  في الانتظار   @endif @if($cart->status == 'done')  تم   @endif   </p>
                    <p> تاريخ الطلب: {{$cart->created_at}}  </p>
                    @if($cart->status == 'waiting')
                        <div class="container">
                            <form  action="{{route('cart.done',$cart->id)}}" method="POST">
                                @csrf
                                @method('post')
                                <button type="submit" style="margin-block: 2px" class="btn btn-success btn-block">تعيين كجاهزة</button>
                            </form>
                        </div>
                        <div class="container">
                            <form  action="{{route('cart.delete',$cart->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" id="del" style="margin-block: 2px" class="btn btn-danger btn-block">حذف</button>
                            </form>
                        </div>
                    @endif



                </div>
            </div>
        </div>

        <div class="col-sm-6">

                                <div class="table-responsive-sm table-responsive-md table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المنتج</th>
                                            <th>السعر</th>
                                            <th>حاة العرض</th>
                                            <th>السعر بعد العرض</th>
                                            <th>الكمية</th>
                                            <th>اللون</th>
                                            <th>الاسماء</th>
                                            <th>القياس</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach ($cart->order as $order )
                                            <tr>
                                                <th>{{++$i}}</th>
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$order->product->price}}</td>
                                                <td>
                                                    @if($order->product->status == 0)
                                                        لا يوجد عرض
                                                    @endif
                                                    @if($order->product->status == 1)
                                                        يوجد عرض
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->product->priceSale == null)
                                                        لا يوجد سعر عرض
                                                    @endif
                                                    {{ $order->product->priceSale }}
                                                </td>
                                                <td>{{$order->qty}}</td>
                                                <td>{{$order->color}}</td>
                                                <td>
                                                    @if($order->has_name == null)
                                                        لا يوجد اسم
                                                    @endif
                                                    {{$order->has_name}}
                                                </td>
                                                <td>
                                                    @if($order->has_measure == null)
                                                        لا يوجد قياس
                                                    @endif
                                                    {{$order->has_measure}}
                                                </td>
                                            </tr>
                                       @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>المنتج</th>
                                            <th>السعر</th>
                                            <th>حاة العرض</th>
                                            <th>السعر بعد العرض</th>
                                            <th>الكمية</th>
                                            <th>اللون</th>
                                            <th>الاسماء</th>
                                            <th>القياس</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>


</body>
</html>



