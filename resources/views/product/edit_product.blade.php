@extends('product.product')

@section('title')
تعديل منتج
@endsection

@section('page_name')
    تعديل منتج
@endsection

@section('second_directory')
    تعديل منتج
@endsection

@section('first_directory')
المنتجات
@endsection
@section('type')

    <div class="container">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">اضافة منتج</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('product.update',$product)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>الاسم</label>
                                <input type="text" value="{{$product->name}}" name="name" class="form-control" placeholder="الاسم">
                            </div>
                            @if($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>التفاصيل</label>
                                <textarea class="form-control"  name="details" rows="3" placeholder="التفاصيل">{{$product->details}}</textarea>
                            </div>
                            @if($errors->has('details'))
                                <div class="alert alert-danger">{{ $errors->first('details') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- input states -->
                    <div class="form-group">
                        <!-- text input -->
                        <div class="form-group">
                            <label>السعر</label>
                            <input type="text" value="{{$product->price}}" name="price" class="form-control" placeholder="السعر">
                        </div>
                        @if($errors->has('price'))
                            <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <!-- radio -->
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="status" {{$product->status == 1 ? 'checked' : ''}}>
                                <label class="form-check-label">يوجد عرض</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="status" {{$product->status == 0 ? 'checked' : ''}}>
                                <label class="form-check-label">لا يوجد عرض</label>
                            </div>
                            @if($errors->has('status'))
                                <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- text input -->
                        <div class="form-group">
                            <label>السعر الجديد بعد العرض</label>
                            <input type="text" value="{{$product->priceSale}}" name="priceSale" class="form-control" placeholder="السعر الجديد بعد العرض">
                        </div>
                        @if($errors->has('priceSale'))
                            <div class="alert alert-danger">{{ $errors->first('priceSale') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>النوع</label>
                                <select name="type_id" class="form-control type">
                                    <option value="{{$product->type->id}}" >{{$product->type->name}}</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}"> {{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('type_id'))
                                <div class="alert alert-danger">{{ $errors->first('type_id') }}</div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>الصنف</label>
                                <select name="category_id" class="form-control category" id="category">
                                    <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @if($errors->has('category_id'))
                                <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">موافق</button>
                    </div>
                </form>
                <br>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.card-body -->



    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '.type', function() {

                var type_id = $(this).val();
                var div = $(this).parent();
                var op = " ";

                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('findTypeByName')!!}',
                    data: {
                        'id': type_id
                    },
                    success: function(data) {
                        //console.log(data);
                        op += '<option value="0" selected disabled>اختر الصنف</option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].id + '">' + data[i].name +'</option>';
                        }
                        $('#category').html('');
                        $('#category').append(op);
                    },
                    error: function() {

                    }
                });
            });
        });
    </script>


@endsection

