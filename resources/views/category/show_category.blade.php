@extends('product.product')

@section('title')
    عرض الاصناف
@endsection
@section('page_name')
    عرض الاصناف
@endsection

@section('second_directory')
    عرض الاصناف
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
                <th scope="col">النوع</th>
                <th scope="col">التعديلات</th>

            </tr>
            </thead>
            <tbody>

            @php
                $i=0;
            @endphp
            @foreach ($categories as $category )
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->type->name}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-success btn-block" style="margin-block: 2px" href="{{route('category.edit' ,$category->id)}}"> التعديل</a>
                            </div>

                            <div class="col-sm">
                                <form  action="{{ route('category.delete' , $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="margin-block: 2px" class="btn btn-danger btn-block">حذف</button>
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

