<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BerasRequest;
use App\Beras;
use App\Gabah;
use App\Gudang;
use App\Penggilingan;
use Auth;
use Session;
use DB;

class BerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Beras::all();
        return view('beras.beras',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Penggilingan::all();
        return view('beras.tambah',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BerasRequest $request)
    {
        DB::transaction(function() use ($request){
          $kering = Gudang::where('tipe_barang_gudang','=','gabah_kering')->firstOrFail();
          $basah = Gudang::where('tipe_barang_gudang','=','gabah_basah')->firstOrFail();
          $gudang = Gudang::where('tipe_barang_gudang','=','beras')->firstOrFail();

          $stok_kering = $kering->stok_barang_gudang;
          $stok_basah = $basah->stok_barang_gudang;

          $penggilingan = Penggilingan::findOrFail($request->penggilingan_id);
          foreach (json_decode($penggilingan->gabah_id) as $key => $value) {
            $gabah = Gabah::findOrFail($value);
            if ($gabah->tipe_gabah == 'gabah_kering') {
              $stok_kering -= $gabah->jumlah_gabah;
            }else {
              $stok_basah -= $gabah->jumlah_gabah;
            }
          }

          $beras = Beras::create([
            'penggilingan_id' => $request->penggilingan_id,
            'user_id' => Auth::id(),
            'tanggal_masuk_beras' => date('Y-m-d',strtotime($request->tanggal_masuk_beras)),
            'jumlah_beras' => $request->jumlah_beras,
            'jumlah_kampil' => $request->jumlah_kampil
          ]);

          $kering->update(['stok_barang_gudang' => $stok_kering]);
          $basah->update(['stok_barang_gudang' => $stok_basah]);
          $gudang->update(['stok_barang_gudang' => $request->jumlah_beras]);

          Session::flash('alert','Berhasil mendambah data beras dari penggilingan gabah');
          Session::flash('alert-class','alert-success');
        });
        return redirect(url('gudang/beras'));
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
        $data = Beras::where('id',$id)->get();
        return view('beras.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BerasRequest $request, $id)
    {
        DB::transaction(function() use ($request,$id){
          $data = $request->except('_token','_method');
          $data['user_id'] = Auth::user()->id;
          $data['tanggal_masuk_beras'] = date('Y-m-d',strtotime($data['tanggal_masuk_beras']));
          $beras = Beras::findOrFail($id);
          $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
          $jml_bf = $beras->jumlah_beras;
          $jml_af = $data['jumlah_beras'];
          if ($jml_bf < $jml_af) {
            //penambahan
            $stok += $jml_af - $jml_bf ;
          }elseif ($jml_bf > $jml_af) {
            //pengurangan
            $stok -= $jml_bf - $jml_af;
          }
          if (Beras::where('id',$id)->update($data)) {
            Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
            Session::flash('alert','Berhasil merubah data beras. ');
            Session::flash('alert-class','alert-success');
          }
        });

        return redirect('gudang/beras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id){
          $currentBeras = Beras::findOrFail($id);
          $penggilingan = Penggilingan::findOrFail($currentBeras->penggilingan_id);
          $gabahKering = Gudang::where('tipe_barang_gudang','=','gabah_kering')->firstOrFail();
          $gabahBasah = Gudang::where('tipe_barang_gudang','=','gabah_basah')->firstOrFail();
          $beras = Gudang::where('tipe_barang_gudang','=','beras')->firstOrFail();

          $stokGabahKering = $gabahKering->stok_barang_gudang;
          $stokGabahBasah = $gabahBasah->stok_barang_gudang;

          foreach (json_decode($penggilingan->gabah_id) as $key => $value) {
            $gabah = Gabah::findOrFail($value);
            if ($gabah->tipe_gabah == 'gabah_kering') {
              $stokGabahKering += $gabah->jumlah_gabah;
            }else {
              $stokGabahBasah += $gabah->jumlah_gabah;
            }
          }

          $currentBeras->delete();
          $gabahKering->update(['stok_barang_gudang' => $stokGabahKering]);
          $gabahBasah->update(['stok_barang_gudang' => $stokGabahBasah]);
          $beras->update(['stok_barang_gudang' => ($beras->stok_barang_gudang - $currentBeras->jumlah_beras)]);

          Session::flash('alert','Berhasil menghapus data beras');
          Session::flash('alert-class','alert-success');
        });
        return redirect('gudang/beras');;
    }
}
