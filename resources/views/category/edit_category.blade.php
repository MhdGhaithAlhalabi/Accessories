@extends('product.product')

@section('title')
    تعديل صنف
@endsection

@section('page_name')
    تعديل صنف
@endsection

@section('second_directory')
    تعديل صنف
@endsection

@section('first_directory')
     المنتجات
@endsection
@section('type')

<div class="container">
    <p>تعديل  صنف</p>
<form action="{{route('category.update',$category)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="category_name">الاسم</label>
        <label>
            <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control" placeholder="الاسم">
        </label>
        @if($errors->has('category_name'))
            <div class="alert alert-danger">{{ $errors->first('category_name') }}</div>
        @endif
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
            <label for="category_image">الاسم</label>
            <label>
                <input type="text" name="category_image" value="{{$category->category_image}}" class="form-control" placeholder="الصورة">
            </label>
            @if($errors->has('category_image'))
                <div class="alert alert-danger">{{ $errors->first('category_image') }}</div>
            @endif
        </div>
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

