@extends('inc.layout')

@section('page_title')
create new book
@endsection

@section('content')

    {{-- @include('inc.errors') --}}

@if(session()->has("success"))
{{ session()->get("success")}}
@endif

<form action="{{route('storeBook') }}" method="post" enctype="multipart/form-data">

    @csrf
    <div class="row mt-5">
        <div class="col-md-6">
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="title">
            @error('title')
            {{ $message }}
            @enderror

            <input type="number" name="price" class="form-control" placeholder="price" value="{{ old('price') }}" min=0>
            @error('price')
            {{ $message }}
            @enderror

            <textarea name="desc" class="form-control" cols="20" rows="5">{{ old('desc') }}</textarea>
            @error('desc')
            {{ $message }}
            @enderror

            <select name="cat_id">
                @foreach ($categories as $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="file" name="image" id="">

    </div>
    <button type="submit" class="btn btn-primary">send</button>

</form>

@endsection
