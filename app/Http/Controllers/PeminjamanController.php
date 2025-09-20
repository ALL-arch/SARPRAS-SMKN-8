<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        // ambil inventaris yang masih tersedia (jumlah > 0)
        $inventaris = Inventaris::where('jumlah', '>', 0)->get();
        return view('peminjaman.create', compact('inventaris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'      => 'required|string|max:255',
            'kode_barang'        => 'required|exists:inventaris,kode_barang',
            'lokasi_penempatan'  => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date',
        ]);

        // ambil data inventaris sesuai kode_barang
        $inventaris = Inventaris::where('kode_barang', $request->kode_barang)->first();

        if (!$inventaris || $inventaris->jumlah <= 0) {
            return back()->withErrors(['kode_barang' => 'Barang tidak tersedia untuk dipinjam.']);
        }

        // buat peminjaman baru (jumlah selalu 1)
        Peminjaman::create([
            'nama_peminjam'      => $request->nama_peminjam,
            'kode_barang'        => $inventaris->kode_barang,
            'nama_barang'        => $inventaris->nama_barang,
            'jumlah'             => 1,
            'lokasi_penempatan'  => $request->lokasi_penempatan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
        ]);

        // kurangi jumlah inventaris, pastikan tetap 0 atau 1
        $inventaris->jumlah = max(0, $inventaris->jumlah - 1);
        $inventaris->save();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'nama_peminjam'      => 'required|string|max:255',
            'lokasi_penempatan'  => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date',
        ]);

        $peminjaman->update([
            'nama_peminjam'      => $request->nama_peminjam,
            'lokasi_penempatan'  => $request->lokasi_penempatan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // kalau dihapus, kembalikan jumlah barang, pastikan maksimum 1
        $inventaris = Inventaris::where('kode_barang', $peminjaman->kode_barang)->first();
        if ($inventaris) {
            $inventaris->jumlah = min(1, $inventaris->jumlah + 1);
            $inventaris->save();
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
