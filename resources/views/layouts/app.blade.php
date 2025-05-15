<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        {{-- Logo bên trái --}}
          <a class="nav-link {{ request()->is('/dashboard') ? 'active text-primary fw-bold' : '' }}" href="/dashboard"> <img style="width: 120px"  src="data:image/png;base64,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" alt=""></a>

        {{-- Toggle trên mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/dashboard') ? 'active text-primary fw-bold' : '' }}" href="/dashboard">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cv') ? 'active text-primary fw-bold' : '' }}" href="/cv">CV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/jobs') ? 'active text-primary fw-bold' : '' }}" href="/admin/jobs">Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('apply') ? 'active text-primary fw-bold' : '' }}" href="/apply">Nộp hồ sơ</a>
                </li>

 <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>


                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


            </ul>
        </div>
    </div>
</nav>

            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
