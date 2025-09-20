@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-yellow-500">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
        

        <!-- Logo + Judul -->
        <div class="flex items-center justify-center gap-4 mb-6">
             <img src="{{ asset('logo-smkn8.png') }}" alt="Logo SMKN 8" class="h-20 w-20 object-contain">
             <div class="text-left">
             <h1 class="text-xl font-bold text-gray-800">Inventaris Sarana</h1>
             <h2 class="text-lg font-semibold text-gray-800">SMK Negeri 8 Kota Serang</h2>
        </div>
</div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    required autofocus autocomplete="username"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-yellow-500 focus:border-yellow-500" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me + Lupa Password -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded text-yellow-500 focus:ring-yellow-400">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-yellow-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-yellow-500 text-black py-3 rounded-lg font-semibold shadow-md hover:bg-yellow-600 transition">
                Login
            </button>
        </form>

        <!-- Register link (opsional) -->
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-yellow-600 hover:underline">Daftar disini</a>
            </p>
        @endif
    </div>
</div>
@endsection
