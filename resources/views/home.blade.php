@extends('inc.layout')

@section('style')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('page_title')
home
@endsection

@section('content')

		<div class="container_home">
		    <div class="card_home">

		        <h1 class="title_home">About Our Library</h1>

		        <p class="subtitle">Welcome to our library!
                 We are dedicated to providing a wide range of books, magazines,
                  and other resources to cater to your interests. Whether you're a bookworm, 
                a student, or simply someone who enjoys reading, we have something for everyone.</p>

		        <button class="btn_home">Get Started</button>
		    </div>
		    <div class="blob"></div>
		</div>

@endsection
