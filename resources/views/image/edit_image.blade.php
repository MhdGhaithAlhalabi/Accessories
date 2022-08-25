@extends('product.product')

@section('title')
    تعديل صورة
@endsection

@section('page_name')
    تعديل صورة
@endsection

@section('second_directory')
    تعديل صورة
@endsection

@section('first_directory')
     عرض المنتجات
@endsection
@section('type')

<div class="container">
    <p>تعديل صورة</p>
<form action="{{route('image.update',$image)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="color">الرابط</label>
        <label>
            <input type="text" name="url" value="{{$image->url}}" class="form-control" placeholder="الرابط">
        </label>
        @if($errors->has('url'))
            <div class="alert alert-danger">{{ $errors->first('url') }}</div>
        @endif
      <input type="hidden" name="color_id" value="{{$color->id}}">
        @if($errors->has('color_id'))
            <div class="alert alert-danger">{{ $errors->first('color_id') }}</div>
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

