<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> تعديل صورة</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">

</head>
<body>


<div class="container" style="padding: 5px">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">تعديل صورة</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
    </div>
</div>
</body>
</html>


