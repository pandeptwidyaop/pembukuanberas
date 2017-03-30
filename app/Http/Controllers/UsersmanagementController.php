<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;

class UsersmanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('users.users',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.tambah');
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
        $user = new User;
        if ($data['password'] == $data['password2']) {
          $user->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'level' => 2,
            'active' => 1
          ]);
          $user->save();
          Session::flash('alert','Berhasil menambah user.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Pastikan password yang anda masukan sama.');
          Session::flash('alert-class','alert-danger');
        }

        return redirect('/users');;
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
      if (User::find($id)->delete()) {
        Session::flash('alert','Berhasil menghapus user.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menghapus user.');
        Session::flash('alert-class','alert-dangers');
      }
      return redirect('users');
    }

    public function setStatus($id){
      $status = User::where('id',$id)->first()->active;
      if ($status == 1) {
        User::where('id',$id)->update(['active' => 0]);
      }else{
        User::where('id',$id)->update(['active' => 1]);
      }
      Session::flash('alert','Berhasil merubah status user.');
      Session::flash('alert-class','alert-success');
      return redirect('users');;
    }
}
