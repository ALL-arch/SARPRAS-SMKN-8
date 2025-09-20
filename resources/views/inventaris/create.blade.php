@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Inventaris</h1>

    <div class="bg-white shadow rounded-xl p-6 w-full md:w-2/3 lg:w-1/2">
        <form action="{{ route('inventaris.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Kode Barang --}}
            <div>
                <label class="block font-semibold mb-1">Kode Barang</label>
                <input type="text" name="kode_barang" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                       value="{{ old('kode_barang') }}" required>
                @error('kode_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Barang --}}
            <div>
                <label class="block font-semibold mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                       value="{{ old('nama_barang') }}" required>
                @error('nama_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah" min="1"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                       value="{{ old('jumlah', 1) }}" required>
                <p class="text-xs text-gray-500 mt-1">Jumlah minimal 1 supaya tampil di list sebagai Tersedia.</p>
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
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Barang Bergerak" {{ old('kategori') == 'Barang Bergerak' ? 'selected' : '' }}>Barang Bergerak</option>
                    <option value="Barang Tetap" {{ old('kategori') == 'Barang Tetap' ? 'selected' : '' }}>Barang Tetap</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" 
                        class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
                    Simpan
                </button>
                <a href="{{ route('inventaris.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
