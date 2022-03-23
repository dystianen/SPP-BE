<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primarykey = 'id_petugas';
    protected $fillable = ['email','password' ,'nama_petugas' , 'level'];
    public $timestamps = false;
}
