
<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل نوع</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">

</head>
<body>


<div class="container" style="padding: 5px">
    <div class="card card-primary" style="direction: rtl">
        <div class="card-header">
            <h3 class="card-title">تعديل نوع</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
    <form action="{{route('type.update',$type)}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">الاسم</label>
            <label>
                <input type="text" name="type_name" value="{{$type->type_name}}" class="form-control" placeholder="الاسم">
            </label>
            @if($errors->has('type_name'))
                <div class="alert alert-danger">{{ $errors->first('type_name') }}</div>
            @endif

        </div>
        {{-- <div class="form-group">
             <label for="name">type_image</label>
             <label>
                 <input type="text" name="type_image" value="{{$type->type_image}}" class="form-control" placeholder="الصورة">
             </label>
             @if($errors->has('type_image'))
                 <div class="alert alert-danger">{{ $errors->first('type_image') }}</div>
             @endif

         </div>--}}
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
    </form>

</div>
    </div>
</div>


</body>
</html>







