@extends('product.product')

@section('title')
    تعديل نوع
@endsection

@section('page_name')
    تعديل نوع
@endsection

@section('second_directory')
    تعديل نوع
@endsection

@section('first_directory')
     المنتجات
@endsection
@section('type')

<div class="container">
    <p>edit type</p>
<form action="{{route('type.update',$type)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">type_name</label>
        <label>
            <input type="text" name="type_name" value="{{$type->type_name}}" class="form-control" placeholder="الاسم">
        </label>
        @if($errors->has('type_name'))
            <div class="alert alert-danger">{{ $errors->first('type_name') }}</div>
        @endif

    </div>
   {{-- <div class="form-group">
        <label for="name">type_image</label>
        <label>
            <input type="text" name="type_image" value="{{$type->type_image}}" class="form-control" placeholder="الصورة">
        </label>
        @if($errors->has('type_image'))
            <div class="alert alert-danger">{{ $errors->first('type_image') }}</div>
        @endif

    </div>--}}
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
</form>

</div>

@endsection

