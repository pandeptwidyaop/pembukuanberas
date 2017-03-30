<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Pegawai;
use App\Kehadiran;
use Session;
use Auth;
use Carbon\Carbon;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Absen::orderBy('id','DESC')->get();
        return view('absen.absen',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = date('Y-m-d',strtotime(Carbon::now('Asia/Jakarta')));
        if (Absen::where('tanggal',$date)->get()->count() == 1) {
          Session::flash('alert','Tidak bisa melakukan absensi di tanggal yang sama.');
          Session::flash('alert-class','alert-danger');
          return redirect('kepegawaian/absen');;
        }else {
          $data = [
            'user_id' => Auth::user()->id,
            'tanggal' => $date
          ];
          $absen = new Absen;
          $absen->fill($data);
          $absen->save();
          $pegawai = Pegawai::all();
          foreach ($pegawai as $r) {
            $absensi = [
              'absen_id' => $absen->id,
              'pegawai_id' => $r->id
            ];
            $k = new Kehadiran;
            $k->fill($absensi);
            $k->save();
          }
          return redirect('kepegawaian/absen/absensi/'.$absen->id);
        }

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
        if (Absen::find($id)->delete()) {
          Session::flash('alert','Berhasil menghapus data absen');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data absen');
          Session::flash('alert-class','alert-danger');
        }

        return redirect('kepegawaian/absen');;
    }
}
