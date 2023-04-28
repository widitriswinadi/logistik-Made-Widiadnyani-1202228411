<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengiriman','tanggal_kirim','layanan','nama_pengirim','alamat_pengirim','nama_penerima','alamat_penerima','id_kodepos','nohp_penerima'
    ];
}
