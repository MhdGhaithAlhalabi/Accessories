@extends('product.product')

@section('title')
    انشاء لون
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
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
       {{-- <svg xmlns="http://www.w3.org/2000/svg">
            <circle cx="15" cy="15" r="15" fill="#42445A" />
        </svg>--}}
        <form action="{{route('color.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اللون</label>

                <div class="row">
                    <div class="col-sm-1">
                        <div class="color-picker" style="direction: ltr"></div>
                    </div>
                    <div class="col-sm-5">
                            <input type="text" name="color" class="form-control" placeholder="اللون كتابة">
                        @if($errors->has('color'))
                            <div class="alert alert-danger">{{ $errors->first('color') }}</div>
                        @endif
                        <label>
                            <input type="hidden" name="color_hex" style="direction: ltr"  id="colo">
                        </label>
                        @if($errors->has('color_hex'))
                            <div class="alert alert-danger">{{ $errors->first('color_hex') }}</div>
                        @endif
                    </div>
                </div>



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
@section('script')

    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>


    <script>
        // Simple example, see optional options for more configuration.
        const pickr = Pickr.create({
            el: '.color-picker',
            theme: 'classic', // or 'monolith', or 'nano'

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
