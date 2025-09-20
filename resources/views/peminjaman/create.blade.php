@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Peminjaman</h1>

    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nama Peminjam --}}
        <div>
            <label class="block font-semibold mb-1">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" 
                   value="{{ old('nama_peminjam') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            @error('nama_peminjam')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kode Barang --}}
        <div>
            <label class="block font-semibold mb-1">Kode Barang</label>
            <select name="kode_barang" id="kode_barang"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <option value="">-- Pilih Kode Barang --</option>
                @foreach($inventaris as $item)
                    <option value="{{ $item->kode_barang }}" 
                        data-nama="{{ $item->nama_barang }}" 
                        data-jumlah="{{ $item->jumlah }}">
                        {{ $item->kode_barang }}
                    </option>
                @endforeach
            </select>
            @error('kode_barang')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Barang (Auto) --}}
        <div>
            <label class="block font-semibold mb-1">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" readonly
                   class="w-full px-4 py-2 border rounded-lg bg-gray-100">
        </div>

        {{-- Jumlah (Auto) --}}
        <div>
            <label class="block font-semibold mb-1">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" readonly
                   class="w-full px-4 py-2 border rounded-lg bg-gray-100">
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block font-semibold mb-1">Lokasi Penempatan</label>
            <input type="text" name="lokasi_penempatan" 
                   value="{{ old('lokasi_penempatan') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            @error('lokasi_penempatan')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Peminjaman --}}
        <div>
            <label class="block font-semibold mb-1">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" 
                   value="{{ old('tanggal_peminjaman') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            @error('tanggal_peminjaman')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex space-x-2">
            <button type="submit" 
                    class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
                Simpan
            </button>
            <a href="{{ route('peminjaman.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Batal
            </a>
        </div>
    </form>

    {{-- Script Auto Isi Nama Barang & Jumlah --}}
    <script>
        document.getElementById('kode_barang').addEventListener('change', function () {
            let selected = this.options[this.selectedIndex];
            document.getElementById('nama_barang').value = selected.getAttribute('data-nama') || '';
            document.getElementById('jumlah').value = selected.getAttribute('data-jumlah') || '';
        });
    </script>
@endsection
