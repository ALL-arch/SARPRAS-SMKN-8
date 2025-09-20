<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalService extends Model
{
    use HasFactory;

    protected $table = 'jadwal_service';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'tanggal_service',
        'vendor',
        'keterangan_service', // konsisten dengan controller
    ];
}
