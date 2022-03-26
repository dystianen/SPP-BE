<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PetugasModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function inputpetugas(Request $req){
        $validator = Validator::make($req->all(),
        [
            'email'=>'required',
            'password'=>'required',
            'nama_petugas'=>'required',
            'level'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save=PetugasModel::create([
            'email'=>$req->email,
            'password'=>$req->password,
            'nama_petugas'=>$req->nama_petugas,
            'level'=>$req->level,
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }

    }
    public function updatepetugas(Request $req ,$id_petugas){
        $validator = Validator::make($req->all(),[
            
            'email'=>'required',
            'password'=>'required',
            'nama_petugas'=>'required',
            'level'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $updatepetugas=PetugasModel::where('id_petugas' ,$id_petugas)->update([
            'email'=>$req->email,
            'password'=>Hash::make($req->get('password')),
            'nama_petugas'=>$req->nama_petugas,
            'level'=>$req->level,
        ]);
        if($updatepetugas){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }

    }
    public function getpetugas(){
        $getpetugas=DB::table('petugas')->get();
        return Response()->json(['data'=>$getpetugas]);
    }
    public function hapuspetugas($id_petugas){
        $hapuspetugas=PetugasModel::where('id_petugas',$id_petugas)->delete();
        if($hapuspetugas){
            return Response ()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
}
