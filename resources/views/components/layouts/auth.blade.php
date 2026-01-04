<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login Admin' }} - Mathali'ul Anwar</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}?v={{ time() }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-zinc-50 dark:bg-zinc-950 font-sans antialiased text-zinc-900 dark:text-zinc-100 py-12 px-4 sm:px-6 lg:px-8">

    <div class="w-full max-w-md space-y-8">
        
        <div class="flex flex-col items-center text-center">
            <div class="h-16 w-16 bg-white dark:bg-zinc-900 rounded-xl flex items-center justify-center shadow-sm border border-zinc-200 dark:border-zinc-800 mb-4 p-2">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Mathali'ul Anwar" class="h-full w-full object-contain">
            </div>

            <h2 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                Mathali'ul Anwar
            </h2>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Sistem Informasi Manajemen Pondok
            </p>
        </div>

        <div class="bg-white dark:bg-zinc-900 py-8 px-6 shadow-xl rounded-2xl border border-zinc-200 dark:border-zinc-800 sm:px-10">
            {{ $slot }}
        </div>

        <div class="text-center">
            <p class="text-xs text-zinc-400 dark:text-zinc-600">
                &copy; {{ date('Y') }} Pondok Pesantren Mathali'ul Anwar.<br>
                All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>