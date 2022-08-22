@extends('product.product')

@section('title')
    انشاء صورة
@endsection

@section('page_name')
    انشاء صورة
@endsection

@section('second_directory')
    انشاء صورة
@endsection

@section('first_directory')
     عرض المنتجات
@endsection

@section('type')

    <div class="container">
        <p>انشاء صورة</p>
        <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="url" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>

                @if($errors->has('url'))
                    <div class="alert alert-danger">{{ $errors->first('url') }}</div>
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
            <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
        </form>

    </div>

@endsection

