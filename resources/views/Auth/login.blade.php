@extends('inc.layout')

@section('page_title')
login
@endsection


@section('content')


@include('inc.errors')

<h1> Log in</h1>



<div class="mx-auto">
    <div class="col-md-12 ">
        <form action="{{route('login') }}" method="post">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputEmail4">
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection
