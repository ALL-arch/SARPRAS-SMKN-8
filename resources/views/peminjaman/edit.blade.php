@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" 
          class="bg-white shadow rounded-xl p-6 max-w-2xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" value="{{ $peminjaman->nama_peminjam }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Kode Barang</label>
                <input type="text" name="kode_barang" value="{{ $peminjaman->kode_barang }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ $peminjaman->nama_barang }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Jumlah</label>
                <input type="number" name="jumlah" value="{{ $peminjaman->jumlah }}" class="w-full border rounded-lg px-3 py-2" min="1" required>
            </div>
            <div class="col-span-2">
                <label class="block font-medium mb-1">Lokasi Penempatan</label>
                <input type="text" name="lokasi_penempatan" value="{{ $peminjaman->lokasi_penempatan }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div class="col-span-2">
                <label class="block font-medium mb-1">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_peminjaman" value="{{ $peminjaman->tanggal_peminjaman }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">Update</button>
            <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
@endsection
