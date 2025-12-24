<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Mathali'ul Anwar</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
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
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="#"
                logo="https://fluxui.dev/img/demo/logo.png"
                logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png"
                name="Mathali'ul Anwar"
            />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>
        <flux:sidebar.search placeholder="Search..." />
        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="{{ route('admin.dashboard') }}" current>
                Dashboard
            </flux:sidebar.item>
            
            @hasrole('super_admin')
            <flux:sidebar.item icon="users" href="{{ route('admin.users.index') }}">
                User Management
            </flux:sidebar.item>

            <flux:sidebar.item icon="inbox" badge="<?php echo App\Models\Message::where('status', 0)->count(); ?>" href="{{ route('admin.messages.index') }}">
                Inbox
            </flux:sidebar.item>

            <div class="text-xs font-semibold uppercase text-zinc-500 dark:text-zinc-400 px-4 py-2 mt-4">
                Website Management
            </div>

            <flux:sidebar.item icon="document-text" href="{{ route('admin.pages.index') }}">
                Profil Pesantren
            </flux:sidebar.item>
            @endhasrole

            @hasanyrole('super_admin|admin_redaksi')
            <flux:sidebar.item icon="newspaper" href="{{ route('admin.posts.index') }}">
                Berita & Mading
            </flux:sidebar.item>
            @endhasanyrole

            @hasanyrole('super_admin|admin_akademik')
            <div class="text-xs font-semibold uppercase text-zinc-500 dark:text-zinc-400 px-4 py-2 mt-4">
                Data Master
            </div>

            <flux:sidebar.item icon="academic-cap" href="{{ route('admin.santri.index') }}">
                Data Santri
            </flux:sidebar.item>

            <flux:sidebar.item icon="calendar" href="{{ route('admin.staff.index') }}">
                Data Guru & Staff
            </flux:sidebar.item>

            <flux:sidebar.item icon="folder-minus" href="{{ route('admin.dorms.index') }}">
                Kamar
            </flux:sidebar.item>

            <flux:sidebar.item icon="chart-bar" href="{{ route('admin.classes.index') }}">
                Kelas Diniyah
            </flux:sidebar.item>

            <flux:sidebar.item icon="calendar-days" href="{{ route('admin.academic.year') }}">
                Tahun Ajaran
            </flux:sidebar.item>

            <flux:sidebar.item icon="folder-minus" href="{{ route('admin.academic.subject') }}">
                Mata Pelajaran
            </flux:sidebar.item>
            
            <div class="text-xs font-semibold uppercase text-zinc-500 dark:text-zinc-400 px-4 py-2 mt-4">
                Absensi
            </div>
            
            <flux:sidebar.item icon="clock" href="{{ route('admin.academic.schedule') }}">
                Jadwal Pelajaran
            </flux:sidebar.item>


            @endhasanyrole

            @hasanyrole('super_admin|admin_akademik|guru')
            <flux:sidebar.item icon="book-open" href="{{ route('admin.attendance.index') }}">
                Absensi Diniyah
            </flux:sidebar.item>
            @endhasanyrole

            @hasanyrole('super_admin|admin_akademik')
            <div class="text-xs font-semibold uppercase text-zinc-500 dark:text-zinc-400 px-4 py-2 mt-4">
                Rekap Absensi
            </div>
            
            <flux:sidebar.item icon="check-circle" href="{{ route('admin.attendance.report') }}">
                Santri
            </flux:sidebar.item>

            <flux:sidebar.item icon="check-circle" href="{{ route('admin.attendance.teacher_report') }}">
                Guru
            </flux:sidebar.item>
            @endhasanyrole

            {{-- <flux:sidebar.item icon="document-text" href="#">Documents</flux:sidebar.item>
            <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item>
            <flux:sidebar.group expandable heading="Favorites" class="grid">
                <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
            </flux:sidebar.group> --}}
        </flux:sidebar.nav>
        <flux:sidebar.spacer />
        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
        </flux:sidebar.nav>
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    {{-- <flux:menu.radio>Truly Delta</flux:menu.radio> --}}
                </flux:menu.radio.group>
                <flux:menu.separator />
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-red-500 rounded-lg hover:text-gray-100 transition-colors">
                        Logout
                    </button>
                </form>
                {{-- <flux:menu.item>
                </flux:menu.item> --}}
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" alignt="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    {{-- <flux:menu.radio>Truly Delta</flux:menu.radio> --}}
                </flux:menu.radio.group>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-gray-100 transition-colors">
                        Logout
                    </button>
                </form>
                {{-- <flux:menu.item> 
                </flux:menu.item> --}}
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    <flux:main>
        {{ $slot }}
        {{-- <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>
        <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>
        <flux:separator variant="subtle" /> --}}
    </flux:main>
    @fluxScripts
</body>
</html>