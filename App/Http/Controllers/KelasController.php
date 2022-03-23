<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\KelasModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class KelasController extends Controller
{
    public function inputkelas (Request $req){
        $validator =  Validator::make($req->all() ,
        [
            'nama_kelas'=>'required',
            'jurusan'=>'required' ,
            'angkatan' => 'required',
        ]);
        if($validator->fails() ) {
            return Response()->json($validator->errors());
        }
        $save = KelasModel::create([
            'nama_kelas'    =>$req->nama_kelas,
            'jurusan'       =>$req->jurusan,
            'angkatan'      =>$req->angkatan,
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
    public function getkelas(){
        $getkelas=DB::table('kelas')->get();
        return Response()->json(['data'=>$getkelas]);
    }
    public function updatekelas(Request $req , $id_kelas){
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            'jurusan'=>'required' ,
            'angkatan' => 'required',
        ]);
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $updatekelas=KelasModel::where('id_kelas',$id_kelas)->update([
        'nama_kelas'=>$req->nama_kelas,
        'jurusan'       =>$req->jurusan,
        'angkatan'      =>$req->angkatan,
    
    ]);
    if($updatekelas){
        return Response()->json(['status'=>1]);
    }else{
        return Response()->json(['status'=>0]);
    }
    }
    public function deletekelas($id_kelas){
        $hapuskelas=KelasModel::where('id_kelas',$id_kelas)->delete();
        if($hapuskelas){
            return Response()->json(['status'=>'berhasil hapus kelas']);
        }else{
            return Response()->json(['status'=>'gagal hapus kelas']);
        }
    }
    public function indexkelas(){
        $kelas=KelasModel::get();
        return Response()->json($kelas);
    
    }
    public function cari_kelas($kata_kunci){
        $kelas=KelasModel::where('nama_kelas','like','%'.$kata_kunci.'%')->get();
        return response()->json($kelas);
    }

    
}
