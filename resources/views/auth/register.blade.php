@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-yellow-500">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
        <!-- Judul -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Akun</h1>
            <p class="text-gray-500 text-sm mt-1">Inventaris SMK Negeri 8 Kota Serang</p>
        </div>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
            </div>

            <!-- Tombol Register -->
            <button type="submit"
                class="w-full bg-yellow-500 text-black py-3 rounded-lg font-semibold shadow-md hover:bg-yellow-600 transition">
                Daftar
            </button>
        </form>

        <!-- Link ke Login -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-yellow-600 hover:underline">Login disini</a>
        </p>
    </div>
</div>
@endsection
