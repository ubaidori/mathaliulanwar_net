<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Homepages' }} - Pond. Pest. Mathali'ul Anwar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-sans text-gray-800 antialiased">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <span class="text-2xl text-slate-800 font-bold text-pesantren-dark">Mathali'ul Anwar</span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="hover:text-pesantren-primary text-slate-800 font-medium transition">Home</a>
                    
                    <a href="{{ route('public.profil', 'sejarah') }}" 
                    class="text-slate-800 hover:text-pesantren-primary font-medium transition">
                    Profil
                    </a>
                    
                    <a href="#" class="bg-pesantren-primary text-white px-5 py-2 rounded-full hover:bg-pesantren-hover transition">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-pesantren-dark text-white py-8 mt-12">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} Mathali'ul Anwar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>