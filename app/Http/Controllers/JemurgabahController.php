<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Gabah;
use App\Jemurgabah;
use Session;
use DB;

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
        DB::transaction(function() use ($request){
          foreach ($request->gabah as $index => $id) {
            Jemurgabah::create([
              'gabah_id' => $id,
              'tanggal_jemurgabah' => date('Y-m-d',strtotime($request->tanggal_jemurgabah)),
              'tanggal_selesai_jemurgabah' => date('Y-m-d',strtotime($request->tanggal_selesai_jemurgabah)),
              'user_id' => Auth::id()
            ]);
          }
          Session::flash('alert','Berhasil menambah data penjemuran gabah.');
          Session::flash('alert-class','alert-success');
        });
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
