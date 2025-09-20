<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::query();

        // Search by nama_barang atau kode_barang
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        // Pagination dengan keyword tetap terbawa
        $inventaris = $query->latest()->paginate(10)->withQueryString();

        // Pastikan display_jumlah untuk view selalu 1 atau 0
        foreach ($inventaris as $item) {
            $item->display_jumlah = $item->jumlah > 0 ? 1 : 0;
        }

        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:inventaris,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'kategori'    => 'required|in:Barang Bergerak,Barang Tetap',
        ]);

        // Pastikan jumlah yang disimpan selalu 1 atau 0
        $jumlah = $request->jumlah > 0 ? 1 : 0;

        Inventaris::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $jumlah,
            'kategori'    => $request->kategori,
        ]);

        return redirect()->route('inventaris.index')
                         ->with('success','Inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventaris)
    {
        return view('inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'kategori'    => 'required|in:Barang Bergerak,Barang Tetap',
        ]);

        // Pastikan jumlah yang diupdate selalu 1 atau 0
        $jumlah = $request->jumlah > 0 ? 1 : 0;

        $inventaris->update([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $jumlah,
            'kategori'    => $request->kategori,
        ]);

        return redirect()->route('inventaris.index')
                         ->with('success','Inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();
        return redirect()->route('inventaris.index')
                         ->with('success','Inventaris berhasil dihapus.');
    }

    // ========================
    // GET BY KODE (untuk peminjaman/pengembalian)
    // ========================
    public function getByKode($kode)
    {
        $barang = Inventaris::where('kode_barang', $kode)
                    ->where('jumlah', '>', 0)
                    ->first();

        if ($barang) {
            // Pastikan display_jumlah tetap 1
            $barang->display_jumlah = 1;

            return response()->json([
                'success' => true,
                'inventaris' => $barang
            ]);
        }

        return response()->json(['success' => false]);
    }
}
