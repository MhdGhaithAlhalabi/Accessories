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
        <label for="name">name</label>
        <label>
            <input type="text" name="name" value="{{$type->name}}" class="form-control" placeholder="الاسم">
        </label>
        @if($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
</form>

</div>

@endsection

