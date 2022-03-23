<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppModel extends Model
{
    protected $table = 'spp';
    protected $primarykey = 'id_spp';
    protected $fillable = ['angkatan' , 'tahun' , 'nominal'];
}
