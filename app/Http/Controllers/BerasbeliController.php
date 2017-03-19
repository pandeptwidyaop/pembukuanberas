<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berasbeli;
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
      $beras = new Berasbeli;
      $beras->fill($data);
      $stok = Gudang::where('tipe_barang_gudang','beras')->first()->stok_barang_gudang;
      $stok += $data['jumlah_berasbeli'];
      if ($beras->save()) {
        Gudang::where('tipe_barang_gudang','beras')->update(['stok_barang_gudang' => $stok]);
        Session::flash('alert','Berhasil menambah data pemebelian beras.');
        Session::flash('alert-class','alert-success');
      }
      return ;
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
}
