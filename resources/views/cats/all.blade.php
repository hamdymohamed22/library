

@extends('inc.layout')

@section('page_title')
    all
@endsection


@section('content')

        @if(session()->has("success"))
        {{ session()->get("success")}}
        @endif

<div class="d-flex justify-content-center">
    <a href="{{ route("createCat") }}" class="btn btn-primary mt-5">create one</a>
</div>

<h1>All Categories </h1>

<div class="row">
    @foreach($categories as $category)
    <div class="col-md-4 mt-3">
        {{ $loop->iteration }} -
        <div class="card" style="width: 18rem;">
            <img src="{{asset("storage/$category->image")}}" class="img-fluid" alt="...">
            <div class="box bg-white">
                <h5 class="p-2 card-title"><a href="{{ url("cats/show/$category->id") }}">{{$category->name }}</a></h5>
                <p class="p-2 text-black-50"> decription: {{ $category->desc }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

    {{ $categories->links() }}

@endsection

