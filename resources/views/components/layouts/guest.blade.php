<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} - Pond. Pest. Mathali'ul Anwar</title>
    
    <link rel="icon" href="{{ asset('img/logo.png') }}?v={{ time() }}" type="image/png">

    <script>
        // Cek LocalStorage (Pilihan User) -> Jika kosong, Cek System Device
        if (localStorage.getItem('darkMode') === 'true' || 
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased transition-colors duration-300 bg-white text-gray-800 dark:bg-zinc-950 dark:text-zinc-200"
      x-data="{ 
          darkMode: document.documentElement.classList.contains('dark') 
      }"
      x-init="$watch('darkMode', val => { 
          localStorage.setItem('darkMode', val);
          if (val) {
              document.documentElement.classList.add('dark');
          } else {
              document.documentElement.classList.remove('dark');
              // Hapus settingan manual jika user ingin kembali mengikuti system (opsional, tapi logic standar biasanya disimpan)
          }
      })">

    <nav class="sticky top-0 z-50 transition-colors duration-300 shadow-md bg-white dark:bg-zinc-900 dark:border-b dark:border-zinc-800 dark:shadow-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <span class="text-2xl font-bold transition-colors text-green-600 dark:text-emerald-400 group-hover:text-green-700 dark:group-hover:text-emerald-300">
                            Mathali'ul Anwar
                        </span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6 items-center">
                    
                    <a href="/" class="font-medium transition-colors hover:text-green-600 dark:hover:text-emerald-400 {{ request()->is('/') ? 'text-green-600 dark:text-emerald-400' : 'text-slate-700 dark:text-zinc-300' }}">Home</a>
                    <a href="{{ route('public.profil', 'sejarah') }}" class="font-medium transition-colors hover:text-green-600 dark:hover:text-emerald-400 {{ request()->routeIs('public.profil') ? 'text-green-600 dark:text-emerald-400' : 'text-slate-700 dark:text-zinc-300' }}">Profil</a>
                    <a href="{{ route('public.berita.index') }}" class="font-medium transition-colors hover:text-green-600 dark:hover:text-emerald-400 {{ request()->routeIs('public.berita.*') ? 'text-green-600 dark:text-emerald-400' : 'text-slate-700 dark:text-zinc-300' }}">Berita</a>
                    <a href="{{ route('public.contact') }}" class="font-medium transition-colors hover:text-green-600 dark:hover:text-emerald-400 {{ request()->routeIs('public.contact') ? 'text-green-600 dark:text-emerald-400' : 'text-slate-700 dark:text-zinc-300' }}">Kontak</a>

                    <div class="h-6 w-px bg-gray-300 dark:bg-zinc-700 mx-1"></div>

                    <button @click="darkMode = !darkMode" 
                            class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-200
                                   text-gray-500 hover:bg-gray-100 hover:text-gray-900 
                                   dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white
                                   focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900"
                            title="Ganti Mode Tampilan">
                        
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>

                        <!-- button dark mode -->
                        <!-- <svg x-show="!darkMode" class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0112 15.75c-5.385 0-9.753-4.368-9.753-9.75s4.368-9.752 9.753-9.752c1.052 0 2.062.18 3 .519A9.753 9.753 0 0021.752 15.002z" />
                        </svg>     -->

                        <!-- Ikon Bulan (Outline) -->
                        <svg  x-show="!darkMode" class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>

                    </button>

                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-full font-medium shadow-sm transition-all transform hover:-translate-y-0.5 bg-green-600 hover:bg-green-700 text-white dark:bg-emerald-600 dark:hover:bg-emerald-500">
                        Login
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <footer class="py-8 mt-12 text-white transition-colors duration-300 bg-pesantren-dark dark:bg-black border-t dark:border-zinc-800">
        <div class="text-center">
            <p class="text-sm opacity-90">&copy; {{ date('Y') }} Mathali'ul Anwar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>