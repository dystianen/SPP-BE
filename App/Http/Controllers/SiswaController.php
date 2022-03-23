<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SiswaModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class SiswaController extends Controller
{
    public function inputsiswa (Request $req){
        $validator = Validator::make($req->all(),
        [
            'nisn'=>'required',
            'nis'=>'required',
            'nama'=>'required',
            'id_kelas'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'username'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            $data['status']=false;
            $data['message']=$validator->errors();
            return Response()->json($data);
        }
        $save=SiswaModel::create([
            'nisn'=>$req->nisn,
            'nis'=>$req->nis,
            'nama'=>$req->nama,
            'id_kelas'=>$req->id_kelas,
            'alamat'=>$req->alamat,
            'no_telp'=>$req->no_telp,
            'username'=>$req->username,
            'password'=>Hash::make($req->get('password')),
        ]);
        if($save){
           $data['status']=true;
           $data['message']="sukses menambah siswa";
        }else{
            $data['status']=false;
           $data['message']="gagal menambah siswa";
        }
        return $data;
    }

    public function updatesiswa(Request $req , $nisn)
    {
        $validator = Validator::make($req->all(),
        [
            'nisn'=>'required',
            'nis'=>'required',
            'nama'=>'required',
            'id_kelas'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'username'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $updatesiswa=SiswaModel::where('nisn',$nisn)->update([
            'nisn'=>$req->nisn,
            'nis'=>$req->nis,
            'nama'=>$req->nama,
            'id_kelas'=>$req->id_kelas,
            'alamat'=>$req->alamat,
            'no_telp'=>$req->no_telp,
            'username'=>$req->username,
            'password'=>Hash::make($req->get('password')),
        ]);
        if($updatesiswa){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
       
    }
    public function deletesiswa($nisn){
        $hapus = SiswaModel::where('nisn',$nisn)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }

    }
    public function getsiswa(){
        $getsiswa=SiswaModel::join('kelas','kelas.id_kelas','siswa.id_kelas')
        ->get();
        return Response()->json(['data'=>$getsiswa]);

    }
    public function indexsiswa(){
        $dt=SiswaModel::get();
        return Response()->json($dt);

    }
    public function cari_siswa($kata_kunci){
        $dt=SiswaModel::where('nama','like','%'.$kata_kunci.'%')->get();
        return response()->json($dt);
    }

   
}

