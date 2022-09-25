<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> انشاء صورة</title>
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">

</head>
<body>


<div class="container" style="padding: 5px">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">انشاء صورة</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <form action="{{route('image.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">الرابط</label>
                <label>
                    <input type="text" name="url" class="form-control" placeholder="الرابط">
                </label>
                @if($errors->has('url'))
                    <div class="alert alert-danger">{{ $errors->first('url') }}</div>
                @endif
                <div class="row">
                <label for="color_id">اللون</label>
                <label>
                <select class="form-control" name="color_id" aria-label="Default select example">
                    <option  value="{{$colors->id}}">{{$colors->color}}</option>
                </select>
                </label>
            @if($errors->has('color_id'))
                    <div class="alert alert-danger">{{ $errors->first('color_id') }}</div>
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
    </div>
</div>
</body>
</html>


