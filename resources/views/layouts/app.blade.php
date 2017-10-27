
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

<div class="container">
    <header class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">
                    <a class="nav-link" href="{{action('PollController@index')}}">Polls</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ action('Management\PollController@index') }}">My polls</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{route('logout')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>

                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                @endif
            </ul>
        </nav>

        <a class="navbar-brand" href="#">
            Bootcamp Polls
        </a>
    </header>

    <main role="main">

        @yield('content')

    </main>

    <footer class="footer">
        <p>&copy; Data4You.cz, CodingBootcamp, Slavo Kozar 2017</p>
    </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</div> <!-- /container -->
</body>
</html>
