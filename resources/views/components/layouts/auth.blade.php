<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login Admin' }} - Mathali'ul Anwar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-pesantren-50 font-sans antialiased text-gray-800 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-pesantren-dark">Mathali'ul Anwar</h1>
            <p class="text-gray-500 mt-2">Masuk ke Panel Admin</p>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-pesantren-primary">
            {{ $slot }}
        </div>

        <div class="text-center mt-6 text-sm text-gray-500">
            &copy; {{ date('Y') }} Pondok Pesantren Mathali'ul Anwar
        </div>
    </div>

</body>
</html>