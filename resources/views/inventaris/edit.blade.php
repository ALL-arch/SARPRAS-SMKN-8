@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Inventaris</h1>

    <div class="bg-white shadow rounded-xl p-6 w-full md:w-2/3 lg:w-1/2">
        <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Kode Barang (readonly) --}}
            <div>
                <label class="block font-semibold mb-1">Kode Barang</label>
                <input type="text" 
                       value="{{ $inventaris->kode_barang }}" 
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                       disabled>
                <p class="text-xs text-gray-500 mt-1">Kode barang tidak bisa diubah.</p>
            </div>

            {{-- Nama Barang --}}
            <div>
                <label class="block font-semibold mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" 
                       value="{{ old('nama_barang', $inventaris->nama_barang) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                       required>
                @error('nama_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah" min="1"
                       value="{{ old('jumlah', $inventaris->jumlah) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                       required>
                @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block font-semibold mb-1">Kategori</label>
                <select name="kategori"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                        required>
                    <option value="Barang Bergerak" {{ old('kategori', $inventaris->kategori) == 'Barang Bergerak' ? 'selected' : '' }}>Barang Bergerak</option>
                    <option value="Barang Tetap" {{ old('kategori', $inventaris->kategori) == 'Barang Tetap' ? 'selected' : '' }}>Barang Tetap</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" 
                        class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
                    Update
                </button>
                <a href="{{ route('inventaris.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
