<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gabah;
use App\Jemurgabah;
use App\Giling;
use App\Http\Requests\TambahGabahRequest;
use Auth;
use Session;
use App\Gudang;

class GabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gabah::orderBy('tanggal_masuk_gabah','DESC')->get();
        return view('gabah.gabah',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gabah.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TambahGabahRequest $request)
    {
        $id = $this->generateID();
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $data['id'] = $this->generateID();
        $data['tanggal_masuk_gabah'] = date('y-m-d', strtotime($data['tanggal_masuk_gabah']));
        $g = new Gabah;
        $g->fill($data);
        $g->save();
        if ( $g ) {
          $juml = Gudang::where('tipe_barang_gudang',$data['tipe_gabah'])->first()->stok_barang_gudang;
          $juml += $data['jumlah_gabah'];
          Gudang::where('tipe_barang_gudang',$data['tipe_gabah'])->update(['stok_barang_gudang' => $juml]);
          Session::flash('alert', 'Berhasil menabah gabah.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert', 'Gagal menabah gabah.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/gabah');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_gabah = Gabah::find($id);
        $data_jemur = Jemurgabah::where('gabah_id',$id)->get();
        $data_giling = Giling::where('gabah_id',$id)->get();
        return view('gabah.view',compact('data_gabah','data_jemur','data_giling'));
        //return dd($data_gabah);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Gabah::where('id',$id)->get();
        return view('gabah.edit',compact('data'));
        //return dd($data);
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
        $data['tanggal_masuk_gabah'] = date('Y-m-d',strtotime($data['tanggal_masuk_gabah']));
        $data['user_id'] = Auth::user()->id;
        $gabah = Gabah::where('id',$id)->get();
        $stok = Gudang::where('tipe_barang_gudang',$data['tipe_gabah'])->first()->stok_barang_gudang;
        $jml_bf = $gabah[0]->jumlah_gabah;
        $jml_af = $data['jumlah_gabah'];
        if ($jml_bf < $jml_af) {
          //penambahan
          $stok += $jml_af - $jml_bf ;
        }elseif ($jml_bf > $jml_af) {
          //pengurangan
          $stok -= $jml_bf - $jml_af;
        }
        if (Gabah::where('id',$id)->update($data)) {
          //if ($gabah[0]->tipe_gabah == $data['tipe_gabah']) {
            Gudang::where('tipe_barang_gudang',$data['tipe_gabah'])->update(['stok_barang_gudang' => $stok]);
          //}else {
            //$stok_lama = Gudang::where('tipe_barang_gudang',$gabah[0]->tipe_gabah)->first()->stok_barang_gudang;
            //$stok_lama -= $gabah[0]->jumlah_gabah;
          //  Gudang::where('tipe_barang_gudang',$gabah[0]->tipe_gabah)->update(['stok_barang_gudang' => $stok_lama]);
          //  Gudang::where('tipe_barang_gudang',$data['tipe_gabah'])->update(['stok_barang_gudang' => $stok]);
          //}
          Session::flash('alert','Berhasil mengubah data gabah '.$id.' .');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagagl mengubah data gabah '.$data['id'].' .');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/gabah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gabah = Gabah::where('id',$id)->first();
        $gudang = Gudang::where('tipe_barang_gudang',$gabah->tipe_gabah)->first();
        $stok = $gudang->stok_barang_gudang;
        $stok -= $gabah->jumlah_gabah;
        if (Gabah::find($id)->delete()) {
          Gudang::where('tipe_barang_gudang',$gabah->tipe_gabah)->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil mengghapus data gabah : '.$id);
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal mengghapus data gabah : '.$id);
          Session::flash('alert-class','alert-danger');
        }
        return redirect()->back();;
    }


    public function generateID(){
      $letter = '123456789';
      $a = '';
      for ($i=0; $i < 8 ; $i++) {
        $a .= $letter[rand(0,8)];
      }
      return $a;
    }
}
