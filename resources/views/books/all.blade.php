@extends('inc.layout')

@section('page_title')
all books
@endsection

@section('content')

@if(session()->has("success"))
{{ session()->get("success")}}
@endif



<div class="d-flex justify-content-center">
    <a href="{{ route("createBook") }}" class="btn btn-primary mt-5">create one</a>
</div>


<h1>All Books </h1>


<div class="row">
    @foreach($books as $book)
    <div class="col-md-4 mt-3">
        {{ $loop->iteration }} -
        <div class="card" style="width: 18rem;">
            <img src="{{asset("storage/$book->image")}}" class="img-fluid" alt="...">
            <div class="box bg-white">
                <h5 class="p-2 card-title"><a href="{{ url("books/show/$book->id") }}">{{$book->title }}</a></h5>
                <p class="p-2 text-black-50"> decription: {{ $book->desc }}</p>
                <span class="p-2 text-dark">price: {{$book->price }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{ $books->links() }}

@endsection
