<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />    {{-- <link href="css/styles.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- {{!! HTML::style('css/styles.css') !!}} --}}
    <title>@yield('title') | KPub</title>
</head>
<body>
    <div id="content-wrap">
    <nav class="navbar navbar-expand-md navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{URL::asset('/img/logo-bk.png')}}" alt="logo image" height="36" class="d-inline-block align-text-middle">
                KPub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->routeIs('home')) ? 'active' : '' }}" href="{{route('home.index')}}"><i class="fas fa-home m-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('idols*')) ? 'active' : '' }}" href="{{route('idol.index')}}" >
                            <i class="fas fa-microphone-alt m-1"></i>Idols
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('groups*')) ? 'active' : '' }}" href="{{route('group.index')}}" >
                            <i class="fas fa-compact-disc m-1"></i>Groups
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('dreamgroups*')) ? 'active' : '' }}" href="{{route('dream-group.index')}}"><i class="fas fa-users m-1"></i>Fanmade Groups</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('favorites')) ? 'active' : '' }}" href="{{ route('fav.index') }}"><i class="fas fa-user-circle m-1"></i>Your Bias</a>
                        </li>
                        <li class='nav-item'>
                            <form method="post" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="btn nav-link border-0">Logout</button>
                            </form>
                        </li>
                    @else 
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('registration.index') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('auth.loginForm') }}">Login</a>
                        </li>
                    @endif 
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('about')) ? 'active' : '' }}" href="{{route('about')}}">About</a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>
    <div class="container content-cont">
        <div class="row">
            <div class="col-12 p-3">
                <header class="py-3">
                    <h2 class="text-center">@yield('title')</h2>
                </header>
                <hr>
                @if (session('error'))
                    <div class="alert alert-danger-custom my-3" role="alert">
                        <i class="far fa-sad-tear"></i> {{ session('error') }}
                    </div>
                    <hr>
                @endif
                <main>
                    @if (session('success'))
                        <div class="alert alert-success-custom my-3" role="alert">
                            <i class="far fa-laugh"></i></i> {{ session('success') }}
                        </div>
                        <hr>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <footer id="footer" class="d-flex justify-content-center align-items-center">
        <img src="{{URL::asset('/img/logo-bk.png')}}" alt="logo image" height="46px" class="d-inline-block align-text-middle m-1">
        KPub 2021
    </footer>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    
    @yield('page-script')
</body>

</html>