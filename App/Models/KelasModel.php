<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primarykey = 'id_kelas';
    protected $fillable = ['nama_kelas' , 'jurusan' , 'angkatan'];
    public $timestamps = false;
}
    