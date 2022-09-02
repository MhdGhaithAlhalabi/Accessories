@extends('product.product')

@section('title')
    تعديل اللون
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
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
            <div class="color-picker"></div>
            <input type="text" name="color" value="{{$color->color}}" class="form-control" placeholder="اللون">
        </label>
        @if($errors->has('color'))
            <div class="alert alert-danger">{{ $errors->first('color') }}</div>
        @endif
            <input type="hidden" name="color_hex" style="direction: ltr"  id="colo">
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

@endsection

@section('script')

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
@endsection
