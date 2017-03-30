<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Gudang;
use App\Gabah;
use App\Beras;
use App\Berasbeli;
use App\Sekam;
use App\Dedak;
use App\Penjualan;
use App\Absen;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function harian(){
      $now = date('Y-m-d',strtotime(Carbon::now('Asia/Jakarta')));
      $gudang = Gudang::all();
      $gabah = Gabah::where("tanggal_masuk_gabah", "=",$now)->get();
      $berasgabah = Beras::where("tanggal_masuk_beras","=",$now)->get();
      $berasbeli = Berasbeli::where("tanggal_berasbeli","=",$now)->get();
      $sekam = Sekam::where("tanggal_masuk_sekam","=",$now)->get();
      $dedak = Dedak::where("tanggal_masuk_dedak","=",$now)->get();
      $penjualan = Penjualan::where("tanggal_penjualan","=",$now)->get();
      $absen = Absen::where("tanggal","=",$now)->get();
      return view('pdf.laporanharian',compact('now','gudang','gabah','berasgabah','berasbeli','sekam','dedak','penjualan','absen'));
    }
}
