@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Jadwal Service</h1>

<div class="bg-white shadow rounded-xl p-6 w-full md:w-2/3 lg:w-1/2">
    <form action="{{ route('jadwal_service.update', $jadwal_service->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Kode Barang --}}
        <div>
            <label class="block font-semibold mb-1">Kode Barang</label>
            <select name="kode_barang" id="kode_barang"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                <option value="">-- Pilih Kode Barang --</option>
                @foreach($inventaris as $inv)
                    <option value="{{ $inv->kode_barang }}" data-nama="{{ $inv->nama_barang }}"
                        {{ old('kode_barang', $jadwal_service->kode_barang) == $inv->kode_barang ? 'selected' : '' }}>
                        {{ $inv->kode_barang }}
                    </option>
                @endforeach
            </select>
            @error('kode_barang')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Barang (readonly) --}}
        <div>
            <label class="block font-semibold mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang"
                   value="{{ old('nama_barang', $jadwal_service->nama_barang) }}"
                   class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                   readonly required>
        </div>

        {{-- Tanggal Service --}}
        <div>
            <label class="block font-semibold mb-1">Tanggal Service</label>
            <input type="date" name="tanggal_service"
                   value="{{ old('tanggal_service', $jadwal_service->tanggal_service) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
            @error('tanggal_service')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Vendor --}}
        <div>
            <label class="block font-semibold mb-1">Vendor</label>
            <input type="text" name="vendor"
                   value="{{ old('vendor', $jadwal_service->vendor) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
        </div>

        {{-- Keterangan Service --}}
        <div>
            <label class="block font-semibold mb-1">Keterangan Service</label>
            <textarea name="keterangan_service" rows="3"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">{{ old('keterangan_service', $jadwal_service->keterangan_service) }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex items-center space-x-3 pt-4">
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
                Update
            </button>
            <a href="{{ route('jadwal_service.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>

<script>
    // JS untuk update nama barang saat pilih kode
    const kodeSelect = document.getElementById('kode_barang');
    const namaInput = document.getElementById('nama_barang');

    kodeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        namaInput.value = selectedOption.dataset.nama || '';
    });

    window.addEventListener('DOMContentLoaded', function() {
        const selectedOption = kodeSelect.options[kodeSelect.selectedIndex];
        namaInput.value = selectedOption ? selectedOption.dataset.nama : '';
    });
</script>
@endsection
