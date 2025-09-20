<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Total barang
        $totalBarang = Inventaris::count();

        // Barang tersedia (jumlah > 0)
        $barangTersedia = Inventaris::where('jumlah', '>', 0)->count();

        // Barang dipinjam (jumlah = 0)
        $barangDipinjam = Inventaris::where('jumlah', '=', 0)->count();

        // List inventaris untuk tabel ringkasan
        $inventaris = Inventaris::latest();

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $inventaris = $inventaris->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $inventaris = $inventaris->paginate(10)->withQueryString();

        return view('dashboard', compact(
            'totalBarang',
            'barangTersedia',
            'barangDipinjam',
            'inventaris'
        ));
    }
}
