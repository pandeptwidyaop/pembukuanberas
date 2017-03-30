<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Absen;
use App\Kehadiran;
use App\Gajimaster;
use Session;
use App\Gaji;
use Auth;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Gajimaster::all();
        $data = DB::table('absens')
          ->select(
            DB::raw("MONTH(tanggal) as bulan, YEAR(tanggal) as tahun"),
            DB::raw("COUNT(DISTINCT(tanggal)) as total_hari"),
            DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 1 THEN 1 ELSE 0 END) AS total_hadir"),
            DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 0 THEN 1 ELSE 0 END) AS total_absen")
            )
          ->join('kehadirans','absens.id','=','kehadirans.absen_id')
          ->groupBy(DB::raw("YEAR(tanggal),MONTH(tanggal)"))
          ->orderBy('bulan','DESC')
          ->orderBy('tahun','DESC')
          ->get();
        return view('penggajian.penggajian',compact('data','status'));
    }

    public function penggajian($bulan,$tahun){
      $gajimaster = Gajimaster::all();
      $gaji = Gaji::orderBy('created_at','DESC')->first()->gaji;
      $gaji_id = 0;
      foreach ($gajimaster as $r) {
        if ($r->bulan == $bulan && $r->tahun == $tahun) {
          $gaji = Gaji::where('id',$r->gaji_id)->first()->gaji;
          $gaji_id = $r->gaji_id;
        }
      }
      $data = DB::table("absens")
        ->select(
          DB::raw("pegawais.nama_pegawai"),
          DB::raw("MIN(pegawais.id) as id"),
          DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 1 THEN 1 ELSE 0 END) AS hadir"),
          DB::raw("SUM(CASE WHEN kehadirans.absen_masuk = 1 THEN TIMEDIFF(kehadirans.waktu_keluar,kehadirans.waktu_masuk) ELSE 0 END) as jam_kerja")
          )
        ->join("kehadirans","absens.id","=","kehadirans.absen_id")
        ->join("pegawais","kehadirans.pegawai_id","=","pegawais.id")
        ->whereRaw("MONTH(absens.tanggal) = $bulan AND YEAR(absens.tanggal) = $tahun")
        ->groupBy("pegawais.nama_pegawai")
        ->get();
      return view('penggajian.detailbulan',compact('data','gaji','bulan','tahun','gaji_id'));
    }

    public function detailgaji($bulan,$tahun,$id,$gaji_id = null){
      $gaji = Gaji::orderBy('created_at','DESC')->first()->gaji;
      if ($gaji_id != null) {
        $gaji = Gaji::where('id',$gaji_id)->first()->gaji;
      }
      $data  = DB::table('absens')
        ->select(
            DB::raw("pegawais.nama_pegawai"),
            DB::raw("DAY(absens.tanggal) as tanggal_kerja"),
            DB::raw("CASE WHEN kehadirans.absen_masuk = 1 THEN TIMEDIFF(kehadirans.waktu_keluar,kehadirans.waktu_masuk) ELSE 0 END as jam_kerja")
          )
        ->join("kehadirans","absens.id","=","kehadirans.absen_id")
        ->join("pegawais","kehadirans.pegawai_id","=","pegawais.id")
        ->whereRaw("MONTH(absens.tanggal) = $bulan AND YEAR(absens.tanggal) = $tahun AND kehadirans.pegawai_id = $id")
        ->get();
        return view('penggajian.detail',compact('data','gaji','bulan','tahun'));
        //dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
