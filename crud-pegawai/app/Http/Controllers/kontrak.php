<?php

namespace App\Http\Controllers;

use App\Models\jabatan_pegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama_pegawai'=> 'required|max:191',
            'alamat'=> 'required|max:100',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'400',
                'error'=>$validator->messages(),
            ]);
        }
        else{
            $pegawai = new Pegawai;
            $pegawai->nama_pegawai = $request->input('nama_pegawai');
            $pegawai->alamat = $request->input('alamat');
            $pegawai->save();
            return response()->json([
                'status'=>200,
                'message'=>'Pegawai berhasil ditambahkan'
            ]);
        }
    }

    public function delete($id){
        $pegawai = Pegawai::find($id);
        if($pegawai){
            $pegawai->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Pegawai berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Pegawai tidak ditemukan'
            ]);
        }
    }

    public function edit($id){
        $pegawai = Pegawai::find($id);
        if($pegawai){
            return response()->json([
                'status'=>200,
                'pegawai'=>$pegawai,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'pegawai tidak ditemukan',
            ]);
        }
    }
    
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nama_pegawai'=> 'required|max:191',
            'alamat'=> 'required|max:100',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'400',
                'error'=>$validator->messages(),
            ]);
        }
        else{
            $pegawai = Pegawai::find($id);
            if($pegawai){
                $pegawai->nama_pegawai = $request->input('nama_pegawai');
                $pegawai->alamat = $request->input('alamat');
                $pegawai->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'pegawai berhasil diubah'
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Pegawai tidak ditemukan'
                ]);
            }
        }

    }
}
