@extends('product.product')

@section('title')
انشاء منتج
@endsection

@section('page_name')
    انشاء منتج
@endsection

@section('second_directory')
    انشاء منتج
@endsection

@section('first_directory')
المنتجات
@endsection

@section('type')

    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">اضافة منتج</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" name="name" class="form-control" placeholder="الاسم">
                        </div>
                        @if($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>التفاصيل</label>
                            <textarea class="form-control" name="details" rows="3" placeholder="التفاصيل"></textarea>
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
                            <input type="text" name="price" class="form-control" placeholder="السعر">
                        </div>
                    @if($errors->has('price'))
                        <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="status">
                            <label class="form-check-label">يوجد عرض</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="status" checked="">
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
                        <input type="text" name="priceSale" class="form-control" placeholder="السعر الجديد بعد العرض">
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
                                <option value="0" selected disabled>اختر النوع</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}"> {{$type->type_name}}</option>
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
                                <option value="0" selected disabled>اختر الصنف</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        @if($errors->has('category_id'))
                            <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <!-- radio -->
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="has_name" checked="">
                                <label class="form-check-label">لا يوجد اسم</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="has_name">
                                <label class="form-check-label">اسم واحد</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="2" name="has_name">
                                <label class="form-check-label">اسمين</label>
                            </div>
                            @if($errors->has('has_name'))
                                <div class="alert alert-danger">{{ $errors->first('has_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
                </div>

            </form>
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
                            op += '<option value="' + data[i].id + '">' + data[i].category_name +'</option>';
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

