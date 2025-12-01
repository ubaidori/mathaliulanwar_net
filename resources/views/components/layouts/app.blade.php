<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Mathali'ul Anwar</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
        trix-editor ul { list-style-type: disc !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
        trix-editor ol { list-style-type: decimal !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
        trix-editor blockquote { border-left: 4px solid #ccc !important; padding-left: 1rem !important; font-style: italic; }
        .trix-content { min-height: 300px; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden bg-gray-100">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition-transform duration-300 transform bg-slate-100 lg:translate-x-0 lg:static lg:inset-0 flex flex-col shadow-lg">
            
            <div class="flex items-center justify-center h-16 bg-pesantren-800">
                <span class="text-slate-900 text-xl font-bold tracking-wide uppercase">Admin Panel</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-md transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-md transition-colors duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita & Mading
                </a>

                <a href="{{ route('admin.pages.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-md transition-colors duration-200 {{ request()->routeIs('admin.pages.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Profil Pesantren
                </a>

                <a href="{{ route('admin.messages.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-md transition-colors duration-200 {{ request()->routeIs('admin.messages.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Kotak Masuk
                    {{-- <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">New</span> --}}
                </a>
            </nav>

            <div class="p-4 border-t border-pesantren-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-md text-gray-800 rounded-lg hover:bg-red-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 overflow-hidden">
            
            <header class="flex items-center justify-between px-6 py-4 bg-slate-100 border-pesantren-800 shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-200 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h2 class="ml-4 text-xl font-semibold text-slate-900 lg:ml-0">{{ $title ?? 'Dashboard' }}</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <div class="text-sm font-bold text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-xs text-slate-600">Administrator</div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-pesantren-100 flex items-center justify-center text-pesantren-700 font-bold border border-pesantren-200">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>

            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>