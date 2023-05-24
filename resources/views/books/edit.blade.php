@extends('inc.layout')

@section('page_title')
edit
@endsection

@section('content')

@include('inc.errors')

<form action="{{route('updateBook',["id"=>$book->id]) }}" method="post" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row mt-5">
        <div class="col-md-6">
            <input type="text" name="title" value="{{$book->title }}" class="form-control" placeholder="title">
            {{-- @error('title')
            {{ $message }}
            @enderror --}}
            <input type="number" name="price" class="form-control" placeholder="price" value="{{ $book->price}}" min=0>

            <textarea name="desc" class="form-control" cols="20" rows="5">{{ $book->desc }}</textarea>

            <select name="cat_id">
                <option value="{{ $book->cat->id }}">{{ $book->cat->name }}</option>
                @foreach ($categories as $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="card" style="width: 18rem;">
            <img name="image" src="{{asset("storage/$book->image")}}" class="img-fluid" alt="" srcset="">
            <input type="file" name="image" class="btn" id="">
        </div>

    </div>
    <button type="submit" class="btn btn-primary">update</button>

</form>


@endsection
