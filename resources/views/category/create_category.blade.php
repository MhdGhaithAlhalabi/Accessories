@extends('product.product')

@section('title')
    انشاء صنف
@endsection

@section('page_name')
    انشاء صنف
@endsection

@section('second_directory')
    انشاء صنف
@endsection

@section('first_directory')
     المنتجات
@endsection

@section('type')

    <div class="container">
        <form action="{{route('category.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">الاسم</label>
                <label>
                    <input type="text" name="name" class="form-control" placeholder="الاسم">
                </label>
                @if($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                <div class="row">
                <label for="type_id">النوع</label>
                <label>
                <select class="form-control" name="type_id" aria-label="Default select example">
                    @foreach($types as $type)
                    <option  value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                </label>
            @if($errors->has('type_id'))
                    <div class="alert alert-danger">{{ $errors->first('type_id') }}</div>
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

