<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;
use App\Gajimaster;
use Session;

class GajiController extends Controller
{
    public function getGaji(){
      return  response()->json([
        'gaji' => Gaji::orderBy('created_at','DESC')->first()->gaji
      ]);
    }

    public function setGaji(Request $request){
      $gaji = new Gaji;
      $gaji->fill($request->all());
      if ($gaji->save()) {
        Session::flash('alert','Berhasil menyimpan gaji.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menyimpan gaji.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect('kepegawaian/penggajian');
    }

    public function prosesGaji($bulan,$tahun){
      $id = Gaji::orderBy('created_at','DESC')->first()->id;
      $gm = new Gajimaster;
      $gm->fill(['bulan' => $bulan, 'tahun' => $tahun, 'gaji_id' => $id]);
      if ($gm->save()) {
        Session::flash('alert','Berhasil menyimpan memproses gaji.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menyimpan memproses gaji.');
        Session::flash('alert-class','alert-danger');
      }

      return redirect('kepegawaian/penggajian');
    }
}
