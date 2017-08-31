<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use Auth;
use Session;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::where('user_id','=',Auth::id())->get();
        return view('pengeluaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengeluaran.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'tanggal' => 'required',
          'nama' => 'required',
          'harga' => 'required|integer',
          'banyak' => 'required|integer',
          'total' => 'required|integer'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
        $pengeluaran = Pengeluaran::create($data);
        Session::flash('alert','Berhasil menambah data pengeluaran.');
        Session::flash('alert-class','alert-success');
        return redirect(url('pengeluaran'));
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
        $data = Pengeluaran::find($id);
        return view('pengeluaran.edit', compact('data'));
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
      $this->validate($request,[
        'tanggal' => 'required',
        'nama' => 'required',
        'harga' => 'required|integer',
        'banyak' => 'required|integer',
        'total' => 'required|integer'
      ]);
      $data = $request->all();
      $data['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
      Pengeluaran::find($id)->update($data);
      Session::flash('alert','Berhasil mengubah data pengeluaran.');
      Session::flash('alert-class','alert-success');
      return redirect(url('pengeluaran'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengeluaran::find($id)->delete();
        Session::flash('alert','Berhasil menghapus data pengeluaran.');
        Session::flash('alert-class','alert-success');
        return redirect(url('pengeluaran'));
    }
}
