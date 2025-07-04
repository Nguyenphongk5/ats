<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Raphaël JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <!-- Morris.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Scripts -->
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts (Optional, for better aesthetics) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon (if available) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo on the left -->

                <!-- Toggle on mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        @if (Auth::check())
                                            <div>{{ Auth::user()->name }}</div>
                                        @endif

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
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

        <!-- Footer -->
        <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-16 shadow-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <!-- Company Info -->
                    <div>
                        <h3 class="text-2xl font-bold mb-4 text-white tracking-wide">CMC Technology Corporation</h3>
                        <p class="text-gray-400 leading-relaxed text-sm">
                            A global leader in technology and innovation. We craft digital solutions that power
                            industries, enhance lives, and shape the future.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-white">Quick Links</h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="/dashboard"
                                    class="text-gray-400 hover:text-blue-400 transition duration-300 ease-in-out">🏠
                                    Home</a></li>
                            <li><a href="/cv"
                                    class="text-gray-400 hover:text-blue-400 transition duration-300 ease-in-out">📄
                                    CV</a></li>
                            <li><a href="/admin/jobs"
                                    class="text-gray-400 hover:text-blue-400 transition duration-300 ease-in-out">💼
                                    Jobs</a></li>
                            <li><a href="/apply"
                                    class="text-gray-400 hover:text-blue-400 transition duration-300 ease-in-out">📝
                                    Apply</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-white">Contact Us</h3>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>CMC Tower, Hanoi, Vietnam</li>
                            <li><i class="fas fa-phone-alt mr-2 text-green-400"></i>+84 123 456 789</li>
                            <li><i class="fas fa-envelope mr-2 text-yellow-400"></i>info@cmcglobal.com</li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-white">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="text-gray-400 hover:text-blue-500 transform hover:scale-125 transition duration-300">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-sky-400 transform hover:scale-125 transition duration-300">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-blue-600 transform hover:scale-125 transition duration-300">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-red-500 transform hover:scale-125 transition duration-300">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="mt-16 pt-8 border-t border-gray-700 text-center">
                    <p class="text-sm text-gray-500 tracking-wide">
                        &copy; {{ date('Y') }} <span class="font-semibold text-white">CMC Technology
                            Corporation</span>. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

    </div>
    @stack('scripts')

</body>

</html>
