<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan_pegawai extends Model
{
    use HasFactory;
    protected $table = 'jabatan_pegawais';
    protected $fillable = [
        'nama_jabatan',
        'id_pegawai'
    ];

}
