<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'jumlah',
        'status',
    ];

    protected static function booted()
    {
        static::saving(function ($inventaris) {
            $inventaris->status = $inventaris->jumlah > 0 ? 'Tersedia' : 'Dipinjam';
        });
    }
}
