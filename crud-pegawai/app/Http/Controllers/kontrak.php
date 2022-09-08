<?php

namespace App\Http\Controllers;

use App\Models\jabatan_pegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class kontrak extends Controller
{
    public function index(){
        return view('pegawai.index');
    }

    public function show(){
        $pegawai = Pegawai::all();
        $jabatan = jabatan_pegawai::all();
        return response()->json([
            'pegawai'=>$pegawai,
            'jabatan'=>$jabatan,
        ]);
    }
}
