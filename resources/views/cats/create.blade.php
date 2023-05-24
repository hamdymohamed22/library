
@extends('inc.layout')

@section('page_title')
    create new category    
@endsection

@section('content')

    @include('inc.errors')

    <form action="{{ route('storeCat') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row mt-5">
                <div class="col-md-6">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="title">
                    <textarea name="desc" class="form-control" cols="20" rows="5">{{ old('desc') }}</textarea>
                </div>
                <input type="file" name="image" id="">
            </div>

        <button type="submit" class="btn btn-primary">send</button>
    </form>
@endsection

