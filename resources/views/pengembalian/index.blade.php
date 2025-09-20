@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar Pengembalian Sarana</h1>

    {{-- Tombol Tambah + Search --}}
    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('pengembalian.create') }}" 
           class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
            + Tambah Pengembalian
        </a>

        {{-- Form Search --}}
        <form action="{{ route('pengembalian.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama atau kode barang..."
                   class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300">
            <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('pengembalian.index') }}" 
                   class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mt-2 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto mt-4">
        <table class="w-full bg-white shadow rounded-xl overflow-hidden">
            <thead class="bg-yellow-500 text-black">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Pengembali</th>
                    <th class="px-4 py-2 text-left">Kode Barang</th>
                    <th class="px-4 py-2 text-left">Nama Barang</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Tanggal Pengembalian</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalian as $i => $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $i+1 }}</td>
                        <td class="px-4 py-2">{{ $item->nama_pengembali }}</td>
                        <td class="px-4 py-2">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            {{-- Status statis tanpa database --}}
                           <span class="px-2 py-1 bg-green-200 text-green-800 rounded">Dikembalikan</span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('pengembalian.edit', $item->id) }}" 
                                   class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 shadow">
                                    Edit
                                </a>
                                <form action="{{ route('pengembalian.destroy', $item->id) }}" 
                                      method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 shadow">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                            Belum ada data pengembalian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
