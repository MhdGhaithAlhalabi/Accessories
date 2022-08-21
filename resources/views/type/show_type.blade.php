@extends('product.product')

@section('title')
    عرض الانواع
@endsection
@section('page_name')
    عرض الانواع
@endsection

@section('second_directory')
    عرض الانواع
@endsection

@section('first_directory')
    المنتجات
@endsection

@section('type')

    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-primary" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">الاسم</th>
                <th scope="col">التعديلات</th>

            </tr>
            </thead>
            <tbody>

            @php
                $i=0;
            @endphp
            @foreach ($types as $type )
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$type->name}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-success" href="{{route('type.edit' ,$type->id)}}"> التعديل</a>
                            </div>

                            <div class="col-sm">
                                <form  action="{{ route('type.delete' , $type->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>

                                </form>
                            </div>
                        </div>


                    </td>

                </tr>
            @endforeach



            </tbody>
        </table>
    </div>

@endsection

