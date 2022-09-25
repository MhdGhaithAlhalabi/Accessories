<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل لون</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte_l.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

</head>
<body>


<div class="container" style="padding: 5px">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">تعديل لون</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
<form action="{{route('color.update',$color)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="color">اللون</label>
        <label>
            <div class="color-picker"></div>
            <input type="text" name="color" value="{{$color->color}}" class="form-control" placeholder="اللون">
        </label>
        @if($errors->has('color'))
            <div class="alert alert-danger">{{ $errors->first('color') }}</div>
        @endif
            <input type="hidden" name="color_hex" value="{{$color->color_hex}}" style="direction: ltr"  id="colo">
        @if($errors->has('color_hex'))
            <div class="alert alert-danger">{{ $errors->first('color_hex') }}</div>
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
    <button type="submit" style="margin-block: 2px" class="btn btn-primary btn-block">موافق</button>
</form>

    </div>
    </div>
</div>


 <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>


    <script>
        // Simple example, see optional options for more configuration.
        const pickr = Pickr.create({
            el: '.color-picker',
            theme: 'classic', // or 'monolith', or 'nano'
            default: '{{$color->color_hex}}',

            components: {

                // Main components
                preview: true,
                opacity: false,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: false,
                    hsla: false,
                    hsva: false,
                    cmyk: false,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });
        pickr.on('save',(color)=>{
            let co = color.toHEXA();
            this.colo.value = '#'+co[0]+co[1]+co[2];
        });

    </script>

</body>
</html>
