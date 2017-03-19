<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Gabah;
use App\Jemurgabah;
use Session;

class JemurgabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Gabah::where('gabahs.tipe_gabah','gabah_basah')->get();
      return view('jemurgabah.jemurgabah',compact('data'));
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
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $data['tanggal_jemurgabah'] = date('Y-m-d',strtotime($data['tanggal_jemurgabah']));
        $data['tanggal_selesai_jemurgabah'] = date('Y-m-d',strtotime($data['tanggal_selesai_jemurgabah']));
        $jg = new Jemurgabah;
        $jg->fill($data);
        if ($jg->save()) {
          Session::flash('alert','Berhasil menambah data penjemuran gabah '.$data['gabah_id']);
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menambah data penjemuran gabah '.$data['gabah_id']);
          Session::flash('alert-class','alert-danger');
        }
        return redirect('gudang/gabah');
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
