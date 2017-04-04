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
      $abs = Absen::where('id',$absen)->get();
      $data = Kehadiran::where('id',$id)->get();
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
        $abs = Kehadiran::where('id',$id)->first();
        $masuk = date('Y-m-d',strtotime($abs->waktu_masuk)).' '.$data['waktu_masuk'].':00';
        $keluar = date('Y-m-d',strtotime($abs->waktu_keluar)).' '.$data['waktu_keluar'].':00';
        if (Kehadiran::where('id',$id)->update(['waktu_masuk' => $masuk,'waktu_keluar' => $keluar])) {
          Session::flash('alert','Berhasil menyimpan absensi');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan absensi');
          Session::flash('alert-class','alert-danger');
        }
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
        Kehadiran::where('id',$id)->update(['absen_keluar' => 1 , 'waktu_keluar' => $waktu]);
      }
      return redirect('kepegawaian/absen/absensi/'.$absen);
    }
}
