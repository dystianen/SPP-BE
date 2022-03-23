<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TunggakanModel extends Model
{
    use HasFactory;
    protected $table='tunggakan';
    protected $primaryKey='id_transaksi';
    protected $fillable=[
    	'nisn','bulan_spp','tahun_spp','status_lunas'
    ];
    public $timestamps = false;
}