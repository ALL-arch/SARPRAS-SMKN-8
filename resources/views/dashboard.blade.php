@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

{{-- Cards Info --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-yellow-500 text-black rounded-xl p-6 shadow hover:shadow-lg transition">
        <h2 class="font-semibold text-lg mb-2">Total Barang</h2>
        <p class="text-3xl font-bold">{{ $totalBarang }}</p>
    </div>
    <div class="bg-green-500 text-black rounded-xl p-6 shadow hover:shadow-lg transition">
        <h2 class="font-semibold text-lg mb-2">Barang Tersedia</h2>
        <p class="text-3xl font-bold">{{ $barangTersedia }}</p>
    </div>
    <div class="bg-red-500 text-black rounded-xl p-6 shadow hover:shadow-lg transition">
        <h2 class="font-semibold text-lg mb-2">Barang Dipinjam</h2>
        <p class="text-3xl font-bold">{{ $barangDipinjam }}</p>
    </div>
</div>

{{-- Ringkasan Inventaris --}}
<div class="bg-white shadow rounded-xl p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 space-y-2 md:space-y-0">
        <h2 class="font-semibold text-xl">Ringkasan Inventaris</h2>

        <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-2">
            {{-- Search --}}
            <form action="{{ route('dashboard') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" placeholder="Cari barang..." 
                       value="{{ request('search') }}"
                       class="px-3 py-1 border rounded focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <button type="submit" 
                        class="px-3 py-1 bg-yellow-500 text-black rounded hover:bg-yellow-600 transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border border-yellow-500 rounded-lg">
            <thead class="bg-yellow-500">
                <tr>
                    <th class="px-4 py-3 border-b">No</th>
                    <th class="px-4 py-3 border-b">Kode Barang</th>
                    <th class="px-4 py-3 border-b">Nama Barang</th>
                    <th class="px-4 py-3 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventaris as $i => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 border-b">{{ ($inventaris->currentPage()-1) * $inventaris->perPage() + $i + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->kode_barang }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->nama_barang }}</td>
                    <td class="px-4 py-2 border-b">
                        <span class="px-3 py-1 rounded font-semibold text-white {{ $item->jumlah > 0 ? 'bg-green-600 border-green-600' : 'bg-red-600 border-red-600' }} border-2">
                            {{ $item->jumlah > 0 ? 'Tersedia' : 'Dipinjam' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $inventaris->links() }}
    </div>
</div>
@endsection
