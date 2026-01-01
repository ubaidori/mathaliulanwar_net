<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Mathali'ul Anwar</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Trix Customization */
        trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
        trix-editor ul { list-style-type: disc !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
        trix-editor ol { list-style-type: decimal !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
        trix-editor blockquote { border-left: 4px solid #ccc !important; padding-left: 1rem !important; font-style: italic; }
        .trix-content { min-height: 300px; }
    </style>

    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    
    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        
        <flux:sidebar.header class="">
            <flux:sidebar.brand
                href="{{ route('admin.dashboard') }}"
                logo="{{ asset('img/logo.png') }}"
                name="Mathali'ul Anwar"
            />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.search placeholder="Cari menu..." />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}" :current="request()->routeIs('admin.dashboard')">
                Dashboard
            </flux:navlist.item>

            @hasrole('super_admin')
            <flux:navlist.item icon="users" href="{{ route('admin.users.index') }}" :current="request()->routeIs('admin.users.*')">
                User Management
            </flux:navlist.item>

            <flux:navlist.item icon="inbox" href="{{ route('admin.messages.index') }}" :current="request()->routeIs('admin.messages.*')" badge="{{ App\Models\Message::where('status', 0)->count() ?: null }}">
                Inbox
            </flux:navlist.item>
            @endhasrole
        </flux:navlist>

        @hasanyrole('super_admin|admin_redaksi')
        <flux:navlist variant="outline" class="mt-4">
            <flux:navlist.group heading="Website Management" expandable>
                @hasrole('super_admin')
                <flux:navlist.item icon="document-text" href="{{ route('admin.pages.index') }}" :current="request()->routeIs('admin.pages.*')">
                    Profil Pesantren
                </flux:navlist.item>
                @endhasrole
                
                <flux:navlist.item icon="newspaper" href="{{ route('admin.posts.index') }}" :current="request()->routeIs('admin.posts.*')">
                    Berita & Mading
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
        @endhasanyrole

        @hasanyrole('super_admin|admin_akademik')
        <flux:navlist variant="outline" class="mt-4">
            <flux:navlist.group heading="Data Master" expandable>
                <flux:navlist.item icon="academic-cap" href="{{ route('admin.santri.index') }}" :current="request()->routeIs('admin.santri.*')">
                    Data Santri
                </flux:navlist.item>

                <flux:navlist.item icon="user-group" href="{{ route('admin.staff.index') }}" :current="request()->routeIs('admin.staff.*')">
                    Data Guru & Staff
                </flux:navlist.item>

                <flux:navlist.item icon="building-office" href="{{ route('admin.dorms.index') }}" :current="request()->routeIs('admin.dorms.*')">
                    Kamar / Asrama
                </flux:navlist.item>

                <flux:navlist.item icon="rectangle-stack" href="{{ route('admin.classes.index') }}" :current="request()->routeIs('admin.classes.*')">
                    Kelas Diniyah
                </flux:navlist.item>

                <flux:navlist.item icon="calendar-days" href="{{ route('admin.academic.year') }}" :current="request()->routeIs('admin.academic.year')">
                    Tahun Ajaran
                </flux:navlist.item>

                <flux:navlist.item icon="book-open" href="{{ route('admin.academic.subject') }}" :current="request()->routeIs('admin.academic.subject')">
                    Mata Pelajaran
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
        @endhasanyrole

        @hasanyrole('super_admin|admin_akademik|guru')
        <flux:navlist variant="outline" class="mt-4">
            <flux:navlist.group heading="KBM & Absensi" expandable>
                @hasanyrole('super_admin|admin_akademik')
                <flux:navlist.item icon="clock" href="{{ route('admin.academic.schedule') }}" :current="request()->routeIs('admin.academic.schedule')">
                    Jadwal Pelajaran
                </flux:navlist.item>
                @endhasanyrole

                <flux:navlist.item icon="clipboard-document-check" href="{{ route('admin.attendance.index') }}" :current="request()->routeIs('admin.attendance.index')">
                    Isi Absensi
                </flux:navlist.item>

                @hasanyrole('super_admin|admin_akademik')
                <flux:navlist.item icon="chart-pie" href="{{ route('admin.attendance.report') }}" :current="request()->routeIs('admin.attendance.report')">
                    Rekap Santri
                </flux:navlist.item>

                <flux:navlist.item icon="presentation-chart-line" href="{{ route('admin.attendance.teacher_report') }}" :current="request()->routeIs('admin.attendance.teacher_report')">
                    Rekap Guru
                </flux:navlist.item>
                @endhasanyrole
            </flux:navlist.group>
        </flux:navlist>
        @endhasanyrole

        <flux:sidebar.spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Pengaturan</flux:navlist.item>
        </flux:navlist>

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile 
                avatar="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                name="{{ auth()->user()->name }}" 
                detail="{{ auth()->user()->roles->first()->name ?? 'User' }}"
            />
            
            <flux:menu>
                <flux:menu.item href="#" icon="user">Profil Saya</flux:menu.item>
                <flux:menu.separator />
                
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                    @csrf
                </form>

                <flux:menu.item icon="arrow-right-start-on-rectangle" class="text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" type="submit" form="logout-form">
                    Logout
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>

    </flux:sidebar>

    <flux:header class="lg:hidden bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-3" inset="left" />
        
        <flux:spacer />
        
        <flux:dropdown position="bottom" align="end">
            <flux:profile 
                avatar="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
            />
            <flux:menu>
                <div class="px-2 py-1.5 text-sm font-medium text-zinc-500">
                    {{ auth()->user()->name }}
                </div>
                <flux:menu.separator />
                <flux:menu.item href="#" icon="user">Profil Saya</flux:menu.item>
                <flux:menu.item icon="arrow-right-start-on-rectangle" class="text-red-500" type="submit" form="logout-form">
                    Logout
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <flux:main class="bg-white dark:bg-zinc-800">
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>
</html>