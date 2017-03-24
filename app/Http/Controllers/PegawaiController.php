<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pegawai;
use Session;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();
        return view('pegawai.pegawai',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.tambah');
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
        $data['user_id'] = Auth::user()->id;
        $p = new Pegawai;
        $p->fill($data);
        if ($p->save()) {
          Session::flash('alert','Berhasil menambah pegawai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menambah pegawai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('kepegawaian/pegawai');
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
        $data = Pegawai::where('id',$id)->get();
        return view('pegawai.edit',compact('data'));
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
        if (Pegawai::where('id',$id)->update($data)) {
          Session::flash('alert','Berhasil menyimpan data pegawai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data pegawai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('kepegawaian/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Pegawai::find($id)->delete()) {
          Session::flash('alert','Berhasil menghapus data pegawai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data pegawai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect('kepegawaian/pegawai');
    }
}
