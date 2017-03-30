<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Absen;
use App\Kehadiran;
use Carbon\Carbon;

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
