<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gabah;
use App\Giling;
use DB;
use App\Penggilingan;
use Auth;
use Session;

class GilingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gabah::all();
        return view('giling.giling',compact('data'));
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
        DB::transaction(function() use ($request) {
          $gabah_id = json_encode($request->gabah);
          foreach ($request->gabah as $gabah) {
            $giling = Giling::create(['tanggal_giling' => date('Y-m-d',strtotime($request->tanggal_giling)),'user_id' => Auth::id(),'gabah_id' => $gabah]);
          }
          $penggilingan = Penggilingan::create(['user_id' => Auth::id(),'tanggal_giling' => date('Y-m-d',strtotime($request->tanggal_giling)),'gabah_id' => $gabah_id]);
        });
        Session::flash('alert','Berhasil menambah data penggilingan gabah.');
        Session::flash('alert-class','alert-success');
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
