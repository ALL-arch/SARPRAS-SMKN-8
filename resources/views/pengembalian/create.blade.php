@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Pengembalian</h1>

    <div class="bg-white shadow rounded-xl p-6 w-full md:w-2/3 lg:w-1/2">
        <form action="{{ route('pengembalian.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama Pengembali (manual) --}}
            <div>
                <label class="block font-semibold mb-1">Nama Pengembali</label>
                <input type="text" name="nama_pengembali" value="{{ old('nama_pengembali') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-yellow-300" required>
                @error('nama_pengembali')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kode Barang (pilih dari peminjaman yg masih Dipinjam) --}}
            <div>
                <label class="block font-semibold mb-1">Kode Barang</label>
                <select name="kode_barang" id="kode_barang"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-yellow-300" required>
                    <option value="">-- Pilih Kode Barang --</option>
                    @foreach($peminjaman as $item)
                        <option value="{{ $item->kode_barang }}"
                                data-nama="{{ $item->nama_barang }}"
                                data-jumlah="{{ $item->jumlah }}">
                            {{ $item->kode_barang }}
                        </option>
                    @endforeach
                </select>
                @error('kode_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Barang (auto, readonly) --}}
            <div>
                <label class="block font-semibold mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed"
                       readonly>
            </div>

            {{-- Jumlah (auto, readonly) --}}
            <div>
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed"
                       readonly>
            </div>

            {{-- Tanggal Pengembalian --}}
            <div>
                <label class="block font-semibold mb-1">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-yellow-300" required>
                @error('tanggal_pengembalian')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center space-x-3 pt-4">
                <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600 shadow">
                    Simpan
                </button>
                <a href="{{ route('pengembalian.index') }}"
                   class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Script untuk auto isi Nama Barang & Jumlah --}}
    <script>
        document.getElementById('kode_barang').addEventListener('change', function() {
            let option = this.options[this.selectedIndex];
            if (option.value) {
                document.getElementById('nama_barang').value = option.dataset.nama;
                document.getElementById('jumlah').value = option.dataset.jumlah;
            } else {
                document.getElementById('nama_barang').value = '';
                document.getElementById('jumlah').value = '';
            }
        });
    </script>
@endsection
