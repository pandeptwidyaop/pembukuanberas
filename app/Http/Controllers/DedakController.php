<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dedak;
use App\Gabah;
use App\Gudang;
use Auth;
use Session;

class DedakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dedak::all();
        return view('dedak.dedak',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Gabah::all();
        return view('dedak.tambah',compact('data'));
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
        $data['tanggal_masuk_dedak'] = date('Y-m-d',strtotime($data['tanggal_masuk_dedak']));
        $dedak = new Dedak;
        $dedak->fill($data);
        $stok = Gudang::where('tipe_barang_gudang','dedak')->first()->stok_barang_gudang;
        $stok += $data['jumlah_dedak'];
        if ($dedak->save()) {
          Gudang::where('tipe_barang_gudang','dedak')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil menambahkan data dedak dari gabah : '.$data['gabah_id']);
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menambahkan data dedak dari gabah : '.$data['gabah_id']);
          Session::flash('alert-class','alert-danger');
        }

        return redirect('gudang/dedak');;
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
        $data = Dedak::where('id',$id)->get();
        return view('dedak.edit',compact('data'));
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
        $data['tanggal_masuk_dedak'] = date('Y-m-d',strtotime($data['tanggal_masuk_dedak']));
        $stok = Gudang::where('tipe_barang_gudang','dedak')->first()->stok_barang_gudang;
        $jml_bf = Dedak::where('id',$id)->first()->jumlah_dedak;
        $jml_af = $data['jumlah_dedak'];
        if ($jml_bf < $jml_af) {
          //penambahan
          $stok += $jml_af - $jml_bf ;
        }elseif ($jml_bf > $jml_af) {
          //pengurangan
          $stok -= $jml_bf - $jml_af;
        }
        if (Dedak::where('id',$id)->update($data)) {
          Gudang::where('tipe_barang_gudang','dedak')->update(['stok_barang_gudang' => $stok]);
          Session::flash('alert','Berhasil mengubah data dedak.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal mengubah data dedak.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/dedak');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $stok = Gudang::where('tipe_barang_gudang','dedak')->first()->stok_barang_gudang;
      $stok -= Dedak::where('id',$id)->first()->jumlah_dedak;
      if (Dedak::find($id)->delete()) {
        Gudang::where('tipe_barang_gudang','dedak')->update(['stok_barang_gudang' => $stok]);
        Session::flash('alert','Berhasil mengubah menghapus data dedak.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal mengubah menghapus data dedak.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect('gudang/dedak');;
    }
}
