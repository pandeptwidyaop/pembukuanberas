<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berasbeli;
use App\Gudang;
use Auth;
use Session;

class BerasbeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Berasbeli::all();
      return view('berasbeli.berasbeli',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berasbeli.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->except('_token');
      $data['user_id'] = Auth::user()->id;
      $data['tanggal_berasbeli'] = date('Y-m-d',strtotime($data['tanggal_berasbeli']));
      $beras = new Berasbeli;
      $beras->fill($data);
      $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
      $stok += $data['jumlah_berasbeli'];
      if ($beras->save()) {
        Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
        Session::flash('alert','Berhasil menambah data pemebelian beras.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menambah data pemebelian beras.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect('gudang/beliberas');
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
        $data = Berasbeli::where('id',$id)->get();
        return view('berasbeli.edit',compact('data'));
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
        $data['tanggal_berasbeli'] = date('Y-m-d',strtotime($data['tanggal_berasbeli']));
        $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
        $jml_bf = Berasbeli::where('id',$id)->first()->jumlah_berasbeli;
        $jml_af = $data['jumlah_berasbeli'];
        if ($jml_bf < $jml_af) {
          //penambahan
          $stok += $jml_af - $jml_bf ;
        }elseif ($jml_bf > $jml_af) {
          //pengurangan
          $stok -= $jml_bf - $jml_af;
        }
        if (Berasbeli::where('id',$id)->update($data)) {
          Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil menyimpan data pemebelian beras.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data pemebelian beras.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/beliberas');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
        $stok -= Berasbeli::where('id',$id)->first()->jumlah_berasbeli;
        if (Berasbeli::find($id)->delete()) {
          Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil menghapus data pembelian beras');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data pembelian beras');
          Session::flash('alert-class','alert-danger');
        }

        return redirect('gudang/beliberas');;
    }
}
