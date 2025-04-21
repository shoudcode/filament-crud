<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel App</title>

    @vite('resources/css/app.css') {{-- atau hapus kalau belum pakai Vite --}}
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

    @livewireScripts
</body>
</html>
