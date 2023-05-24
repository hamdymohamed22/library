<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Library</a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @guest

                <li class="nav-item">
                    <a class=" nav-link" href="{{ route('loginForm') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link" href="{{ route('signup') }}">signup</a>
                </li>
                @endguest
            </ul>

            @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('allCats') }}">All Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('allBooks') }}">All Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>

            <form action="{{route('logout') }}" class="d-flex" method="post">
                @csrf
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>
