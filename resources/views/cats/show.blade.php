@extends('inc.layout')

@section('page_title')
show one
@endsection

@section('content')


related books :<br>

@foreach ($category->books as $book )

<ul>
    <li>
        <a href="{{route('showBook',["id"=>$book->id])}}">
            {{ $book->title }}
        </a>
    </li>
</ul>

@endforeach

<div class="container d-flex justify-content-center align-items-center mt-5">

    <div class="card d-flex" style="width: 18rem;">
        <a href="{{ route('allCats') }}" class="btn btn-info">Back</a>
        <img src="{{asset("storage/$category->image")}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">title: {{$category->name }}</h5>
            <p class="card-text"> about: {{$category->desc }}</p>
            <div class="d-flex">
                <a href="{{ url("cats/edit/$category->id") }}" class="btn btn-primary">edit</a>
                <form action="{{ url("cats/delete/$category->id") }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
