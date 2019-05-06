<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="relative select-none bg-grey lg:flex lg:items-stretch w-full container mx-auto">
            <div class="flex flex-no-shrink items-stretch h-24">
                <div class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark">
                    <div class="text-gray-700 fill-current h-14 w-14">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg>
                    </div>
                    <span class='text-gray-700 text-xl leading-tight'>
                        Content<br/>Calendar
                    </span>
                </div>
                @auth
                <a href="/calendar" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark hover:underline">Calendar</a>
                <a href="/projects" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark hover:underline">Projects</a>
                {{-- <a href="/reports" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark hover:underline">Reports</a> --}}
                <a href="/configure" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark hover:underline">Configure</a>
                @endauth
            </div>
            <div class="flex items-center ml-auto">
                <div class="lg:flex lg:items-stretch lg:justify-end ml-auto">
                    @auth
                    <a class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark"href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <div>
                        <div class="rounded-full h-10 w-10 bg-black text-white flex items-center justify-center">
                            {{auth()->user()->first_name[0]}}{{auth()->user()->last_name[0]}}
                        </div>
                    </div>
                    @endauth
                   {{--  @guest
                    <a class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-gray-700 no-underline flex items-center hover:bg-grey-dark" href="/login">
                        Login
                    </a>
                    @endguest --}}
                </div>
            </div>
            @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
        </nav>

{{--
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
<div class="container mx-auto">
<a class="navbar-brand" href="{{ url('/c') }}">
{{ config('app.name', 'Laravel') }}
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</li>
@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{ Auth::user()->name }} <span class="caret"></span>
</a>

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
</div>
</li>
@endguest
</ul>
</div>
</div>
</nav> --}}

<main class="p-10 bg-gray-200 min-h-screen">
    @yield('content')
</main>
</div>
</body>
</html>
