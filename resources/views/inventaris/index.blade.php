@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar Inventaris</h1>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        {{-- Tombol Tambah --}}
        <a href="{{ route('inventaris.create') }}" 
           class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
            + Tambah Inventaris
        </a>

        {{-- Kolom Search --}}
        <form action="{{ route('inventaris.index') }}" method="GET" class="flex">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama / kode barang..."
                   class="px-4 py-2 border rounded-l-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none w-64">
            <button type="submit" 
                    class="px-4 py-2 bg-yellow-500 text-black hover:bg-yellow-600">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('inventaris.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-black rounded-r-lg hover:bg-gray-400">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="mt-2 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mt-4">
        <table class="w-full bg-white shadow rounded-xl overflow-hidden">
            <thead class="bg-yellow-500 text-black">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Kode Barang</th>
                    <th class="px-4 py-2 text-left">Nama Barang</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventaris as $i => $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ ($inventaris->currentPage() - 1) * $inventaris->perPage() + $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $item->kategori ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->display_jumlah }}</td>
                        <td class="px-4 py-2">
                            @if($item->display_jumlah > 0)
                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded">Tersedia</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded">Dipinjam</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('inventaris.edit', $item->id) }}" 
                                   class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 shadow">
                                    Edit
                                </a>
                                <form action="{{ route('inventaris.destroy', $item->id) }}" 
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
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                            Belum ada data inventaris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $inventaris->links() }}
    </div>
@endsection
