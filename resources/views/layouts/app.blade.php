<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ATS System') }}</title>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Raphaël JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <!-- Morris.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Scripts -->
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts (Optional, for better aesthetics) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon (if available) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="space-y-4">
                        <h3 class="text-2xl font-bold text-gradient">ATS System</h3>
                        <p class="text-gray-300">Modern recruitment platform for the digital age.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">About</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Services</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Services</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Job Posting</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Candidate Search</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">HR Analytics</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Recruitment</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                        <div class="space-y-2 text-gray-300">
                            <p><i class="fas fa-map-marker-alt mr-2"></i> 123 Business St, City</p>
                            <p><i class="fas fa-phone mr-2"></i> +1 234 567 890</p>
                            <p><i class="fas fa-envelope mr-2"></i> info@ats.com</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                    <p>&copy; {{ date('Y') }} ATS System. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
</body>

</html>
