@extends('inc.layout')

@section('page_title')
show one
@endsection

@section('content')




<div class="container d-flex justify-content-center align-items-center mt-5">


    <div class="card d-flex" style="width: 18rem;">
        <a href="{{ route('allBooks') }}" class="btn btn-info">Back</a>

        <img src="{{asset("storage/$one->image")}}" class="card-img-top" alt="...">

        <div class="card-body">
            <h5 class="card-title">title: {{$one->title }}</h5>
            <h6 class="card-title">category name:
                <a href="{{ route('showCat',['id'=>$one->cat->id]) }}">{{$one->cat->name }}</a>
            </h6>
            <p class="card-text"> about: {{$one->desc }}</p>
            <h5 class="card-title">price: ${{$one->price }}</h5>

            <div class="d-flex">
                <a href="{{ url("books/edit/$one->id") }}" class="btn btn-primary">edit</a>
                <form action="{{ url("books/delete/$one->id") }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">delete</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
