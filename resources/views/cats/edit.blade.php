@extends('inc.layout')

@section('page_title')
edit
@endsection

@section('content')

@include('inc.errors')

<form action="{{ url("cats/update/$category->id") }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mt-5">
        <div class="col-md-6">
            <input type="text" name="name" value="{{$category->name }}" class="form-control" placeholder="title">
            {{-- @error('title')
            {{ $message }}
            @enderror --}}
            <textarea name="desc" class="form-control" cols="20" rows="5">{{ $category->desc }}</textarea>
        </div>
        <div class="card" style="width: 18rem;">
            <img name="image" src="{{asset("storage/$category->image")}}" class="img-fluid" alt="" srcset="">
            <input type="file" name="image" class="btn" id="">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">update</button>

</form>

@endsection
