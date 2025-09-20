<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\JadwalService;

class LaporanController extends Controller
{
    // Menu utama laporan
    public function index()
    {
        return view('laporan.index');
    }

    // Laporan inventaris
    public function inventaris()
    {
        $data = Inventaris::all();
        return view('laporan.inventaris', compact('data'));
    }

    // Laporan peminjaman
    public function peminjaman()
    {
        $data = Peminjaman::all();
        return view('laporan.peminjaman', compact('data'));
    }

    // Laporan pengembalian
    public function pengembalian()
    {
        $data = Pengembalian::all();
        return view('laporan.pengembalian', compact('data'));
    }

    // Laporan jadwal service
    public function jadwalService()
    {
        $data = JadwalService::all();
        return view('laporan.jadwal_service', compact('data'));
    }
}
