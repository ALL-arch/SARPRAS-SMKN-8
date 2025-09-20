@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar Jadwal Service</h1>

    <a href="{{ route('jadwal_service.create') }}" 
       class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
        + Tambah Jadwal Service
    </a>

    @if(session('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
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
                    <th class="px-4 py-2 text-left">Tanggal Service</th>
                    <th class="px-4 py-2 text-left">Vendor</th>
                    <th class="px-4 py-2 text-left">Keterangan Service</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $i => $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ ($jadwal->currentPage()-1) * $jadwal->perPage() + $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $item->tanggal_service }}</td>
                        <td class="px-4 py-2">{{ $item->vendor ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->keterangan_service ?? '-' }}</td>
                        <td class="px-4 py-2 space-x-2">
                         <div class="flex items-center space-x-2">   
                            <a href="{{ route('jadwal_service.edit', $item->id) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ route('jadwal_service.destroy', $item->id) }}" 
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                            Belum ada jadwal service.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $jadwal->links() }}
    </div>
@endsection
