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

{{-- ----------------------------------------------------------------------------------- --}}

<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false, userMenuOpen: false }">

    <div class="flex h-screen overflow-hidden bg-gray-100">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition-transform duration-300 transform bg-slate-100 lg:translate-x-0 lg:static lg:inset-0 flex flex-col shadow-lg">
            
            <div class="flex items-center justify-center h-16 bg-pesantren-800">
                <span class="text-slate-900 text-xl font-bold tracking-wide uppercase mt-2">Admin Panel</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                @hasrole('super_admin')
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6 pl-4">
                    Website Content
                </div>

                <a href="{{ route('admin.pages.index') }}" 
                    class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.pages.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Profil Pesantren
                </a>
                @endhasrole

                @hasrole('super_admin|admin_redaksi')
                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita & Mading
                </a>
                @endhasrole

                @hasrole('super_admin|admin_akademik')
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6 pl-4">
                    Data Master
                </div>

                <a href="{{ route('admin.santri.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.santri.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Data Santri
                </a>

                <a href="{{ route('admin.staff.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.staff.*') ? 'bg-emerald-500/7 text-emerald-500 shadow-md' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Data Guru & Staff
                </a>                

                <a href="{{ route('admin.dorms.index') }}" 
                    class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.dorms.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3l4 4m0 0l-4 4m4-4H4"></path></svg>
                    Asrama
                </a>

                <a href="{{ route('admin.classes.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.classes.*') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Kelas Diniyah
                </a>
                
                <a href="{{ route('admin.academic.year') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.academic.year') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Tahun Ajaran
                </a>
                @endhasrole               

                @hasrole('super_admin|admin_akademik')
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6 pl-4">
                    Aktivitas
                </div>

                <a href="{{ route('admin.academic.subject') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.academic.subject') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Mata Pelajaran
                </a>

                <a href="{{ route('admin.academic.schedule') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.academic.schedule') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Jadwal Pelajaran
                </a>

                <a href="{{ route('admin.attendance.report') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.attendance.report') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Rekap Absensi
                </a>
                @endhasrole

                @hasrole('super_admin|admin_akademik|guru')
                <a href="{{ route('admin.attendance.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.attendance.index') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                Absensi Diniyah
                </a>

                @endhasrole
                
                @hasrole('super_admin')
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6 pl-4">
                    Users
                </div>
                
                <a href="{{ route('admin.users.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.users.index') ? 'bg-emerald-500/7 text-emerald-500' : 'text-gray-800 hover:bg-black/7' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                User Management
                </a>    
                @endhasrole
                
            </nav>

            @hasrole('super_admin|admin_akademik|guru|admin_redaksi')
            <!-- Hapus bagian logout di sidebar karena sudah dipindah ke dropdown -->
            @endhasrole
        </aside>

        <div class="flex flex-col flex-1 overflow-hidden">
            
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-800 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h2 class="ml-4 text-xl font-semibold text-gray-900 lg:ml-0">{{ $title ?? 'Dashboard' }}</h2>
                </div>

                @hasrole('super_admin')
                <a href="{{ route('admin.messages.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.messages.*')}}">
                    <button class="relative text-gray-600 hover:text-gray-800 focus:outline-none cursor-pointer">
                        <!-- Ikon Pesan (Chat Bubble) yang lebih jelas -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <!-- Path untuk ikon gelembung pesan dengan tiga titik (...) di dalamnya -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.148A9.006 9.006 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <!-- Penanda Notifikasi (Dot Merah) -->
                        <!-- Posisi di kanan atas ikon -->
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full transform translate-x-1 -translate-y-1"></span>
                    </button>
                </a>      
                @endhasrole 
                

                <div class="flex items-center gap-4 relative">
                    <div class="hidden md:block text-right">
                        <div class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</div>
                        {{-- <div class="text-xs text-gray-500">Administrator</div>     --}}
                    </div>
                    <button @click="userMenuOpen = !userMenuOpen" class="h-10 w-10 rounded-full bg-pesantren-100 flex items-center justify-center text-pesantren-700 font-bold border border-pesantren-200 hover:bg-pesantren-200 transition-colors">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50" style="top: 100%; margin-top: 0.5rem;">
                        <div class="py-1">
                            <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                <div class="font-medium">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
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