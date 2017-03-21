<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BerasRequest;
use App\Beras;
use App\Gabah;
use App\Gudang;
use Auth;
use Session;

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
        $data = Gabah::all();
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
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $data['tanggal_masuk_beras'] = date('Y-m-d',strtotime($data['tanggal_masuk_beras']));
        $jml_gabah = Gabah::where('id',$data['gabah_id'])->first()->jumlah_gabah;
        $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
        $tipe = Gabah::where('id',$data['gabah_id'])->first()->tipe_gabah;
        $stok_gabah = Gudang::where('tipe_barang_gudang',$tipe)->first()->stok_barang_gudang;
        $b = new Beras;
        $b->fill($data);
        if ($b->save()) {
          $stok += $data['jumlah_beras'];
          $stok_gabah -= $jml_gabah;
          Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
          Gudang::where('tipe_barang_gudang',$tipe)->update(['stok_barang_gudang' => $stok_gabah]);
          Session::flash('alert','Berhasil mendambah data beras dari gabah '.$data['gabah_id']);
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal mendambah data beras dari gabah '.$data['gabah_id']);
          Session::flash('alert-class','alert-danger');
        }

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
        $data = $request->except('_token','_method');
        $data['user_id'] = Auth::user()->id;
        $data['tanggal_masuk_beras'] = date('Y-m-d',strtotime($data['tanggal_masuk_beras']));
        $beras = Beras::where('id',$id)->get();
        $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
        $jml_bf = $beras[0]->jumlah_beras;
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
          Session::flash('alert','Berhasil merubah data beras kode gabah: '.$data['gabah_id']);
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal merubah data beras kode gabah: '.$data['gabah_id']);
          Session::flash('alert-class','alert-danger');
        }

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
        $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
        $stok -= Beras::where('id',$id)->first()->jumlah_beras;
        $tipe = Gabah::where('id',Beras::where('id',$id)->first()->gabah_id)->first()->tipe_gabah;
        $stok_gabah = Gudang::where('tipe_barang_gudang',$tipe)->first()->stok_barang_gudang;
        $stok_gabah += Gabah::where('id',Beras::where('id',$id)->first()->gabah_id)->first()->jumlah_gabah;
        if (Beras::find($id)->delete()) {
          Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
          Gudang::where('tipe_barang_gudang',$tipe)->update(['stok_barang_gudang' => $stok_gabah]);
          Session::flash('alert','Berhasil menghapus data beras');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data beras');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/beras');;
    }
}
