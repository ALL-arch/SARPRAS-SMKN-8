<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_service', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');             // barang yang akan diservice
            $table->string('nama_barang');
            $table->date('tanggal_service');          // jadwal service
            $table->string('vendor')->nullable();     // vendor service
            $table->text('keterangan_service')->nullable(); // catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_service');
    }
};
