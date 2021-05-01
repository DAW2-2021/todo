<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: #f8f8f8;
        }

        .todo-nav {
            margin-top: 10px;
        }

        .todo-list {
            margin: 10px 0;
        }

        .todo-list .todo-item {
            padding: 15px;
            margin: 5px 0;
            border-radius: 0;
            background: #f7f7f7;
        }

        .todo-list.only-active .todo-item.complete {
            display: none;
        }

        .todo-list.only-active .todo-item:not(.complete) {
            display: block;
        }

        .todo-list.only-complete .todo-item:not(.complete) {
            display: none;
        }

        .todo-list.only-complete .todo-item.complete {
            display: block;
        }

        .todo-list .todo-item.complete span {
            text-decoration: line-through;
        }

        .remove-todo-item {
            color: #ccc;
            visibility: hidden;
        }

        .remove-todo-item:hover {
            color: #5f5f5f;
        }

        .todo-item:hover .remove-todo-item {
            visibility: visible;
        }

        div.checker {
            width: 18px;
            height: 18px;
        }

        div.checker input,
        div.checker span {
            width: 18px;
            height: 18px;
        }

        div.checker span {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            text-align: center;
            background-position: 0 -260px;
        }

        div.checker,
        div.checker input,
        div.checker span {
            width: 19px;
            height: 19px;
        }

        div.checker,
        div.radio,
        div.uploader {
            position: relative;
        }

        div.button,
        div.button *,
        div.checker,
        div.checker *,
        div.radio,
        div.radio *,
        div.selector,
        div.selector *,
        div.uploader,
        div.uploader * {
            margin: 0;
            padding: 0;
        }

        div.button,
        div.checker,
        div.radio,
        div.selector,
        div.uploader {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            vertical-align: middle;
        }

        .card {
            padding: 25px;
            margin-bottom: 20px;
            border: initial;
            background: #fff;
            border-radius: calc(0.15rem - 1px);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.04), 0 1px 6px rgba(0, 0, 0, 0.04);
        }

        a {
            cursor: pointer;
        }

    </style>
    @yield('extraHeader')
</head>

<body>
    @include('includes.navbar')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>

                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        My profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('includes.footer')
    @yield('extraFooter')
</body>

</html>
