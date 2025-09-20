<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventaris Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-yellow-500 text-black flex flex-col">
        
        <!-- Bagian atas (judul + navigasi) -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <div class="p-4 text-2xl font-bold border-b border-yellow-600">
                Inventaris
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-600">Dashboard</a>
                <a href="{{ route('inventaris.index') }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-600">List Inventaris</a>
                <a href="{{ route('peminjaman.index') }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-600">Peminjaman Sarana</a>
                <a href="{{ route('pengembalian.index') }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-600">Pengembalian Sarana</a>
                <a href="{{ route('jadwal_service.index') }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-600">Jadwal Service</a>
                
    

        <!-- Bagian bawah (logout) -->
        <div class="p-4 border-t border-yellow-600">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6 overflow-y-auto">
        @yield('content')
    </main>
</body>
</html>
