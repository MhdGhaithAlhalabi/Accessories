@extends('product.product')

@section('title')
    انشاء نوع
@endsection

@section('page_name')
    انشاء نوع
@endsection

@section('second_directory')
    انشاء نوع
@endsection

@section('first_directory')
     المنتجات
@endsection

@section('type')

    <div class="container">
        <form action="{{route('type.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">الاسم</label>
                <label>
                    <input type="text" name="name" class="form-control" placeholder="الاسم">
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

