<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primarykey = 'id_pembayaran';
    protected $fillable = ['id_petugas', 'nisn', 'tgl_bayar', 'bulan_spp', 'tahun_spp'];
    public $tampstamps = false;
}