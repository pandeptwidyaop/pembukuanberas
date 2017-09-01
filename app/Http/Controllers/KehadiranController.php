<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Absen;
use App\Kehadiran;
use Carbon\Carbon;
use Session;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Kehadiran::where('absen_id',$id)->get();
        $date = Absen::where('id',$id)->first()->tanggal;
        return view('absen.absensi',compact('data','date','id'));
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
    public function edit($absen,$id)
    {
      $abs = Absen::findOrFail($absen);
      $data = Kehadiran::findOrFail($id);
      if ($data->waktu_masuk == null) {
        Session::flash('alert','Belum melakukan absensi.');
        Session::flash('alert-class','alert-danger');
        return back();
      }
      return view('absen.edit',compact('absen','id','data','abs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $absen, $id)
    {
        $data = $request->except('_token','_method');
        $abs = Kehadiran::findOrFail($id);
        $masuk = $keluar = null;
        if ($abs->waktu_masuk != null) {
          $masuk = date('Y-m-d',strtotime($abs->waktu_masuk)).' '.$data['waktu_masuk'].':00';
        }
        if ($abs->waktu_keluar != null) {
          $keluar = date('Y-m-d',strtotime($abs->waktu_keluar)).' '.$data['waktu_keluar'].':00';
        }
        $kehadiran  = Kehadiran::findOrFail($id);
        $kehadiran->waktu_masuk = $masuk;
        $kehadiran->waktu_keluar = $keluar;
        $kehadiran->save();
        Session::flash('alert','Berhasil menyimpan absensi');
        Session::flash('alert-class','alert-success');
        return redirect('kepegawaian/absen/absensi/'.$absen);
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

    public function absen($absen,$id,$tipe){
      $waktu = Carbon::now('Asia/Jakarta');
      if ($tipe == 'masuk') {
        Kehadiran::where('id',$id)->update(['absen_masuk' => 1 , 'waktu_masuk' => $waktu]);
      }elseif ($tipe == 'keluar') {
        if (Kehadiran::findOrFail($id)->waktu_masuk != null) {
          Kehadiran::where('id',$id)->update(['absen_keluar' => 1 , 'waktu_keluar' => $waktu]);
        }else {
          Session::flash('alert','Belum melakukan absensi masuk.');
          Session::flash('alert-class','alert-danger');
          return back();
        }
      }
      return redirect('kepegawaian/absen/absensi/'.$absen);
    }
}
