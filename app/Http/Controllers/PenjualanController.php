<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Gudang;
use App\Penjualan;
use App\Penjualanitem;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjualan::orderBy('id','DESC')->get();
        return view('penjualan.penjualan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Gudang::all();
        return view('penjualan.tambah',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $p = new Penjualan;
        $p->user_id = Auth::user()->id;
        $p->tanggal_penjualan = date('Y-m-d',strtotime($data['tanggal_penjualan']));
        $p->pembeli_penjualan = $data['pembeli_penjualan'];
        $p->save();
        foreach ($data['item'] as $key => $value) {
          $stok = Gudang::where('id',$key)->first()->stok_barang_gudang;
          $d = [
            'penjualan_id' => $p->id,
            'gudang_id' => $key,
            'harga' => $value['harga'],
            'jumlah' => $value['jumlah']
          ];
          $stok -= $d['jumlah'];
          $pi = new Penjualanitem;
          $pi->fill($d);
          $pi->save();
          Gudang::where('id',$key)->update(['stok_barang_gudang' => $stok]);
        }
        Session::flash('alert','Berhasil menambah data penjualan.');
        Session::flash('alert-class','alert-success');
        return redirect('penjualan/'.$p->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penjualan::where('id',$id)->get();
        $jam = Carbon::now('Asia/Jakarta');
        return view('penjualan.nota',compact('data','jam'));
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
        $penjualan = Penjualan::where('id',$id)->get();
        foreach ($penjualan as $r) {
          foreach ($r->Penjualanitem as $p) {
            $stok = Gudang::where('id',$p->gudang_id)->first()->stok_barang_gudang;
            $stok += $p->jumlah;
            Gudang::where('id',$p->gudang_id)->update(['stok_barang_gudang' => $stok]);
          }
        }
        if (Penjualan::find($id)->delete()) {
          Session::flash('alert','Berhasil menghapus data penjualan');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','gagal menghapus data penjualan');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('penjualan');
    }

    public function barang($tipe){
      $data = Gudang::where('tipe_barang_gudang',$tipe)->first();
      if ($data->stok_barang_gudang == 0) {
        $ret = ['status' => false, 'msg' => 'Stok sedang kosong.'];
      }else {
        $ret = [
          'status' => true,
          'msg' => [
            'harga' => $data->harga_barang_gudang,
            'stok' => $data->stok_barang_gudang,
            'tipe' => $data->tipe_barang_gudang,
            'nama' => $data->nama_barang_gudang,
            'id' => $data->id,
          ]
        ];
      }
      return response()->json($ret);
    }
}
