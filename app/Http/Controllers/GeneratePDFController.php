<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;
use App\Gajimaster;
use App\Kehadiran;
use Illuminate\Support\Facades\DB;
use PDF;

class GeneratePDFController extends Controller
{
    public function generateSlipGaji($bulan,$tahun){
      $gaji = Gajimaster::where([["bulan","=",$bulan],["tahun","=",$tahun]])->get();
      $data = DB::table("absens")
        ->select(
          DB::raw("pegawais.nama_pegawai"),
          DB::raw("MIN(pegawais.alamat) as alamat"),
          DB::raw("COUNT(absens.id) as total_hari"),
          DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 1 THEN 1 ELSE 0 END) AS hadir"),
          DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 1 THEN TIMEDIFF(kehadirans.waktu_keluar,kehadirans.waktu_masuk) ELSE 0 END) as jam_kerja")
          )
        ->join("kehadirans","absens.id","=","kehadirans.absen_id")
        ->join("pegawais","kehadirans.pegawai_id","=","pegawais.id")
        ->whereRaw("MONTH(absens.tanggal) = $bulan AND YEAR(absens.tanggal) = $tahun")
        ->groupBy("nama_pegawai")
        ->get();
        //$pdf = PDF::loadView('pdf.slipgaji',['data' => $data,'gaji' => $gaji, 'bln' => $bulan, 'thn' => $tahun])->setPaper('a4','landscape');
        //return $pdf->download();
      return view('pdf.slipgaji',['data' => $data,'gaji' => $gaji, 'bln' => $bulan, 'thn' => $tahun]);
    }
}
