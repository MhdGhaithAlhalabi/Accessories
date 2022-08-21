@extends('product.product')

@section('title')
    تعديل اللون
@endsection

@section('page_name')
    تعديل اللون
@endsection

@section('second_directory')
    تعديل اللون
@endsection

@section('first_directory')
     عرض المنتجات
@endsection
@section('type')

<div class="container">
    <p>تعديل لون</p>
<form action="{{route('color.update',$color)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="color">اللون</label>
        <label>
            <input type="text" name="color" value="{{$color->color}}" class="form-control" placeholder="اللون">
        </label>
        @if($errors->has('color'))
            <div class="alert alert-danger">{{ $errors->first('color') }}</div>
        @endif
      <input type="hidden" name="product_id" value="{{$product->id}}">
        @if($errors->has('product_id'))
            <div class="alert alert-danger">{{ $errors->first('product_id') }}</div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">موافق</button>
</form>

</div>

@endsection

