<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Models\TunggakanModel;

class TransaksiController extends Controller
{
    public function Transaksi(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'bulan_spp'=>'required',
            'tahun_spp'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $ceklunas=TunggakanModel::where('nisn',$request->get('nisn'))
        	->where('bulan_spp',$request->get('bulan_spp'))
        	->where('tahun_spp',$request->get('tahun_spp'));
        if($ceklunas->count()>0){
        	$dt_status=$ceklunas->first();
        	if($dt_status->status_lunas=="belum lunas"){
	        	$pembayaran = PembayaranModel::create([
		        	'id_petugas'=>JWTAuth::user()->id_petugas,
		        	'nisn'=>$request->get('nisn'),
		        	'tgl_bayar'=>date('Y-m-d'),
		        	'bulan_spp'=>$request->get('bulan_spp'),
		        	'tahun_spp'=>$request->get('tahun_spp'),
		        ]);
		        if($pembayaran){
		        	$update_tunggakan=TunggakanModel::where('nisn',$request->get('nisn'))
		        	->where('bulan_spp',$request->get('bulan_spp'))
		        	->where('tahun_spp',$request->get('tahun_spp'))
		        	->update([
		        		'status_lunas'=>'lunas'
		        	]);
		        	return response()->json(['message'=>'sukses pembayaran']);
		        } else {
		        	return response()->json(['message'=>'Gagal pembayaran']);
		        }
	        } elseif($dt_status->status_lunas=="lunas"){
	        	return response()->json(['message'=>'Bulan ini sudah lunas, tidak perlu membayar']);
	        } 
        } else {
	        	return response()->json(['message'=>'Tidak ada tunggakan']);
	        }
        
        
    }
    public function kurang_bayar($nisn)
    {
    	$gethistori=TunggakanModel::select('siswa.nisn','siswa.nama','kelas.nama_kelas','kelas.jurusan','nominal')->join('siswa','siswa.nisn','=','tunggakan.nisn')
    	->join('kelas','kelas.id_kelas','=','siswa.id_kelas')
    	->join('spp','spp.angkatan','=','kelas.angkatan')
    	->where('tunggakan.nisn',$nisn)
    	->where('status_lunas','Belum Lunas')
    	->get();
    	return response()->json($gethistori);
    }
}