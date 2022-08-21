@extends('product.product')

@section('title')
    انشاء لون
@endsection

@section('page_name')
    انشاء لون
@endsection

@section('second_directory')
    انشاء لون
@endsection

@section('first_directory')
     عرض المنتجات
@endsection

@section('type')

    <div class="container">
        <p>انشاء لون</p>
        <form action="{{route('color.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اللون</label>
                <label>
                    <input type="text" name="color" class="form-control" placeholder="اللون">
                </label>
                @if($errors->has('color'))
                    <div class="alert alert-danger">{{ $errors->first('color') }}</div>
                @endif
                <div class="row">
                    <label for="product_id">المنتج</label>
                        <label>
                    <select class="form-control" name="product_id" aria-label="Default select example">
                    <option  value="{{$products->id}}">{{$products->name}}</option>
                </select>
                </label>
            @if($errors->has('product_id'))
                    <div class="alert alert-danger">{{ $errors->first('product_id') }}</div>
                @endif
                </div>

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

