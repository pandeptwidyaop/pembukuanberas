<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gudang;
use Auth;
use Session;
use App\Http\Requests\StokEditRequest;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Gudang::all();
      return view('gudang.gudang',compact('data'));
      //dd($data_gabah_kering);
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
        $data = Gudang::where('tipe_barang_gudang',$id)->get();
        return view('gudang.edit',compact('data'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StokEditRequest $request, $id)
    {
        $data = $request->except('_method','_token');
        $data['user_id'] = Auth::user()->id;
        if (Gudang::where('tipe_barang_gudang',$id)->update($data)) {
          Session::flash('alert','Berhasil mengubah data stok gudang.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal mengubah data stok gudang.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url('gudang/stok'));
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
