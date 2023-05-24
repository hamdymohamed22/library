@extends('inc.layout')

@section('page_title')
registration
@endsection


@section('content')
<h1>Sign Up </h1>

@include('inc.errors')

<form action="{{route('signin') }}" method="post" class="row g-2">

    @csrf
    <div class="col-md-6">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="inputEmail4">
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail4">
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="inputEmail4">
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="Password" name="password_confirmation" class="form-control" id="inputEmail4">
    </div>

    <div class="col-6">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>

</form>

@endsection
