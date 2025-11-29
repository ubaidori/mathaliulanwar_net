<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Mathali\'ul Anwar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-pesantren-dark text-white shrink-0 flex flex-col transition-all duration-300">
            <div class="p-6 flex items-center justify-center font-bold text-xl border-b border-pesantren-hover">
                Admin Panel
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="/admin/dashboard" class="flex items-center px-4 py-3 bg-pesantren-hover rounded-lg transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.posts.index') }}" 
                class="flex items-center px-4 py-3 {{ request()->routeIs('admin.posts.*') ? 'bg-pesantren-hover' : 'hover:bg-pesantren-hover' }} rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    Kelola Berita
                </a>
                <a href="{{ route('admin.pages.index') }}" 
                class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pages.*') ? 'bg-pesantren-hover' : 'hover:bg-pesantren-hover' }} rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    Profil Pesantren
                </a>
                </nav>
            
                <div class="p-4 border-t border-pesantren-hover">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:text-gray-300 text-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
        </aside>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>