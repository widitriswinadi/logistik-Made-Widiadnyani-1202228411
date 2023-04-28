<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengiriman_barangs', function (Blueprint $table) {
            $table->id();
            $table->char('id_pengiriman', 10);
            $table->date('tanggal_kirim');
            $table->string('layanan',100);
            $table->string('nama_pengirim',100);
            $table->string('alamat_pengirim',100);
            $table->string('nama_penerima',100);
            $table->string('alamat_penerima',100);
            $table->integer('id_kodepos');
            $table->string('nohp_penerima',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_barangs');
    }
};
