<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @yield('style')
    <title>@yield('page_title')</title>

</head>
<body>

@include('inc.navbar')

<div class="container">
@yield('content')
</div>

<script src="{{ asset('bootstrap.min.js') }}"></script>
<script src="{{ asset('all.min.js') }}"></script>
</body>
</html>
