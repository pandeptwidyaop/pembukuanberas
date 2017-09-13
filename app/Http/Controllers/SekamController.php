<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekam;
use App\Gudang;
use App\Gabah;
use App\Beras;
use App\Penggilingan;
use Auth;
use Session;
use DB;

class SekamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Sekam::all();
      return view('sekam.sekam',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penggilingans = $this->selectPenggilinganNotUse();
        return view('sekam.tambah',compact('penggilingans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'penggilingan_id' => 'required',
          'tanggal_masuk_sekam' => 'required',
          'jumlah_sekam' => 'required',
          'jumlah_kampil' => 'required'
        ]);

        DB::transaction(function() use ($request) {
          $data = $request->except('_token');
          $data['user_id'] = Auth::user()->id;
          $data['tanggal_masuk_sekam'] = date('Y-m-d',strtotime($data['tanggal_masuk_sekam']));
          $data['penggilingan_id'] = json_encode($request->penggilingan_id);
          $stok = Gudang::where('tipe_barang_gudang','sekam')->first()->stok_barang_gudang;
          $stok += $data['jumlah_sekam'];
          $sekam = new Sekam;
          $sekam->fill($data);
          if ($sekam->save()) {
            Gudang::where('tipe_barang_gudang','sekam')->update(['stok_barang_gudang' => $stok]);
            Session::flash('alert','Berhasil menambah sekam dari hasil giling gabah.');
            Session::flash('alert-class','alert-success');
          }else {
            Session::flash('alert','Gagal menambah sekam dari hasil giling gabah.');
            Session::flash('alert-class','alert-danger');
          }
        });
        return redirect('gudang/sekam');
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
        $sekam = Sekam::findOrFail($id);
        return view('sekam.edit',compact('sekam'));
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
        $data = $request->except('_token','_method');
        $data['user_id'] = Auth::user()->id;
        $data['tanggal_masuk_sekam'] = date('Y-m-d',strtotime($data['tanggal_masuk_sekam']));
        $stok = Gudang::where('tipe_barang_gudang','sekam')->first()->stok_barang_gudang;
        $jml_bf = Sekam::where('id',$id)->first()->jumlah_sekam;
        $jml_af = $data['jumlah_sekam'];
        if ($jml_bf < $jml_af) {
          //penambahan
          $stok += $jml_af - $jml_bf ;
        }elseif ($jml_bf > $jml_af) {
          //pengurangan
          $stok -= $jml_bf - $jml_af;
        }
        if (Sekam::where('id',$id)->update($data)) {
          Gudang::where('tipe_barang_gudang','sekam')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil merubah data sekam.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal merubah data sekam.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/sekam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stok = Gudang::where('tipe_barang_gudang','sekam')->first()->stok_barang_gudang;
        $stok -= Sekam::where('id',$id)->first()->jumlah_sekam;
        if (Sekam::find($id)->delete()) {
          Gudang::where('tipe_barang_gudang','sekam')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil menghapus data sekam.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data sekam.');
          Session::flash('alert-class','alert-danger');
        }

        return redirect('gudang/sekam');;
    }

    public function count($id){
      $beras = Beras::where('gabah_id',$id)->first()->jumlah_beras;
      $hasil = $beras / 10000;
      return response()->json([
        'hasil' => $hasil,
        'ket' => 'Ini merupakan hasil tidak pasti dari '.$beras.' Kg beras menghasilkan '.$hasil.' truk sekam. ( Jumlah beras dibagi 10.000 kg)'
      ]);
    }

    public function selectPenggilinganNotUse()
    {
      $sekams = Sekam::all();
      $penggilingan_id = [];
      foreach ($sekams as $sekam) {
        foreach (json_decode($sekam->penggilingan_id) as $id) {
          array_push($penggilingan_id,$id);
        }
      }
      return Penggilingan::whereNotIn('id',$penggilingan_id)->get();
    }
}
