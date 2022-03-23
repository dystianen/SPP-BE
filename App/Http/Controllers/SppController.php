<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SppModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class SppController extends Controller
{
    public function inputspp(Request $req){
        $validator = Validator::make($req->all(),
        [
            'angkatan'=>'required',
            'tahun'=>'required',
            'nominal'=>'required',

         ]);
         if($validator->fails()){
             return Response()->json($validator->errors());
         }$save=SppModel::create([
             'angkatan'=>$req->angkatan,
             'tahun'=>$req->tahun,
             'nominal'=>$req->nominal,

         ]);
         if($save){
             return Response()->json(['status'=>1]);
         }else{
             return Response()->json(['status'=>0]);
         }
    }
   public function getspp(){
       $getspp=DB::table('spp')->get();
       return Response()->json(['data'=>$getspp]);
   }
   public function updatespp(Request $req , $id_spp){
       $validator = Validator::make($req->all(),
       [
           'angkatan'=>'required',
           'tahun'=>'required',
           'nominal'=>'required',
       ]);
       if($validator->fails()){
           return Response()->json($validator->errors());
       }$updatespp=SppModel::where('id_spp' ,$id_spp)->update([
            'angkatan'=>$req->angkatan,
            'tahun'=>$req->tahun,
            'nominal'=>$req->nominal,

       ]);
       if($updatespp){
           return Response()->json(['status'=>'berhasil update SPP']);
       }else{
           return Response()->json(['status'=>'gagal update SPP']);
       }
   }
   public function deletespp($id_spp){
       $deletespp=SppModel::where('id_spp',$id_spp)->delete();
      if($deletespp){
        return Response()->json(['status'=>'Berhasil hapus SPP']);
      }else{
        return Response()->json(['status'=>'Gagal hapus SPP']);
      }
   }

}
