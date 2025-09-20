<?php

namespace App\Http\Controllers;

use App\Models\JadwalService;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class JadwalServiceController extends Controller
{
    // ======================
    // INDEX
    // ======================
    public function index(Request $request)
    {
        $query = JadwalService::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%")
                  ->orWhere('vendor', 'like', "%{$search}%");
        }

        $jadwal = $query->orderBy('tanggal_service', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        return view('jadwal_service.index', compact('jadwal'));
    }

    // ======================
    // CREATE
    // ======================
    public function create()
    {
        $inventaris = Inventaris::all(); // ambil semua inventaris untuk dropdown
        return view('jadwal_service.create', compact('inventaris'));
    }

    // ======================
    // STORE
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'       => 'required|string|max:50',
            'nama_barang'       => 'required|string|max:255',
            'tanggal_service'   => 'required|date',
            'vendor'            => 'nullable|string|max:255',
            'keterangan_service'=> 'nullable|string|max:255',
        ]);

        JadwalService::create($request->only([
            'kode_barang',
            'nama_barang',
            'tanggal_service',
            'vendor',
            'keterangan_service'
        ]));

        return redirect()->route('jadwal_service.index')
                         ->with('success', 'Jadwal service berhasil ditambahkan.');
    }

    // ======================
    // EDIT
    // ======================
    public function edit(JadwalService $jadwal_service)
    {
        $inventaris = Inventaris::all(); // ambil inventaris untuk dropdown
        return view('jadwal_service.edit', compact('jadwal_service', 'inventaris'));
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, JadwalService $jadwal_service)
    {
        $request->validate([
            'kode_barang'       => 'required|string|max:50',
            'nama_barang'       => 'required|string|max:255',
            'tanggal_service'   => 'required|date',
            'vendor'            => 'nullable|string|max:255',
            'keterangan_service'=> 'nullable|string|max:255',
        ]);

        $jadwal_service->update($request->only([
            'kode_barang',
            'nama_barang',
            'tanggal_service',
            'vendor',
            'keterangan_service'
        ]));

        return redirect()->route('jadwal_service.index')
                         ->with('success', 'Jadwal service berhasil diupdate.');
    }

    // ======================
    // DESTROY
    // ======================
    public function destroy(JadwalService $jadwal_service)
    {
        $jadwal_service->delete();

        return redirect()->route('jadwal_service.index')
                         ->with('success', 'Jadwal service berhasil dihapus.');
    }
}
