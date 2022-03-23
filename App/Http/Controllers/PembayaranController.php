<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use Illuminate\Support\Facades\Validator;
 
class PembayaranController extends Controller
{
    public function inputpembayaran(Request $req){
        $validator = Validator::make($req->all(),
        [
            'id_petugas'=> 'required',
            'nisn'=>'required',
            'tgl_bayar'=>'required',
            'bulan_spp'=>'required',
            'tahun_spp'=>'required',

        ] );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save=PembayaranModel::create([
            'id_petugas'=>$req->id_petugas,
            'nisn'=>$req->nisn,
            'tgl_bayar'=>$req->tgl_bayar,
            'bulan_spp'=>$req->bulan_spp,
            'tahun_spp'=>$req->tahun_spp,

        ]);
        if($save){
            return Response()->json(['status'=>'berhasil input pembayaran']);
        }else{
            return Response()->json(['status'=>'gagal input pembayaran']);
        }

    }
    public function getpembayaran(){
        $datapembayaran=PembayaranModel::join('siswa' , 'siswa.nisn' ,'pembayaran.nisn')
        ->get();
        return Response()->json(['data'=>$datapembayaran]);
    }
    public function updatepembayaran(Request $req , $id_pembayaran){
        $validator = Validator::make($req->all(),
        [
            'id_petugas'=> 'required',
            'nisn'=>'required',
            'tgl_bayar'=>'required',
            'bulan_spp'=>'required',
            'tahun_spp'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json([$validator->errors()]);
        }
        $updatepembayaran=PembayaranModel::where('id_pembayaran',$id_pembayaran)->update([
            'id_petugas'=>$req->id_petugas,
            'nisn'=>$req->nisn,
            'tgl_bayar'=>$req->tgl_bayar,
            'bulan_spp'=>$req->bulan_spp,
            'tahun_spp'=>$req->tahun_spp,
        ]);
        if($updatepembayaran){
            return Response()->json(['status'=>'Berhasil Update Pembayaran']);
        }else{
            return Response()->json(['status'=>'Gagal Update Pembayaran']);
        }

    }
    public function hapuspembayaran($id){
        $hapus = PembayaranModel::where('id_pembayaran',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }

    }
}
