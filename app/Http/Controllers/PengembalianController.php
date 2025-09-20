<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $query = Pengembalian::query();

        // fitur search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_pengembali', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
        }

        $pengembalian = $query->latest()->get();
        return view('pengembalian.index', compact('pengembalian'));
    }

    // CREATE
    public function create()
    {
        // ambil semua peminjaman yang masih ada (jumlah 1)
        $peminjaman = Peminjaman::all();
        return view('pengembalian.create', compact('peminjaman'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengembali'      => 'required|string|max:255',
            'kode_barang'          => 'required|exists:peminjaman,kode_barang',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::where('kode_barang', $request->kode_barang)->firstOrFail();

        // simpan pengembalian
        Pengembalian::create([
            'nama_pengembali'      => $request->nama_pengembali,
            'kode_barang'          => $request->kode_barang,
            'nama_barang'          => $peminjaman->nama_barang,
            'jumlah'               => 1,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // tambah jumlah inventaris, maksimal 1
        $inventaris = Inventaris::where('kode_barang', $peminjaman->kode_barang)->first();
        if ($inventaris) {
            $inventaris->jumlah = min(1, $inventaris->jumlah + 1);
            $inventaris->save();
        }

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    // EDIT
    public function edit(Pengembalian $pengembalian)
    {
        $peminjaman = Peminjaman::all();
        return view('pengembalian.edit', compact('pengembalian', 'peminjaman'));
    }

    // UPDATE
    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'nama_pengembali'      => 'required|string|max:255',
            'kode_barang'          => 'required|exists:peminjaman,kode_barang',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::where('kode_barang', $request->kode_barang)->first();

        $pengembalian->update([
            'nama_pengembali'      => $request->nama_pengembali,
            'kode_barang'          => $request->kode_barang,
            'nama_barang'          => $peminjaman ? $peminjaman->nama_barang : $pengembalian->nama_barang,
            'jumlah'               => 1,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // update jumlah inventaris, maksimal 1
        if ($peminjaman) {
            $inventaris = Inventaris::where('kode_barang', $peminjaman->kode_barang)->first();
            if ($inventaris) {
                $inventaris->jumlah = min(1, $inventaris->jumlah + 1);
                $inventaris->save();
            }
        }

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    // DESTROY
    public function destroy(Pengembalian $pengembalian)
    {
        // kembalikan stok inventaris, maksimal 1
        $inventaris = Inventaris::where('kode_barang', $pengembalian->kode_barang)->first();
        if ($inventaris) {
            $inventaris->jumlah = min(1, $inventaris->jumlah + 1);
            $inventaris->save();
        }

        $pengembalian->delete();
        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
