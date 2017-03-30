<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('profile.profile');
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
        $data = $request->except('_token','_method');
        if ($data['password'] != null) {
          if ($data['password'] == $data['password2']) {
            User::where('id',$id)->update([
              'name' => $data['name'],
              'password' => Hash::make($data['password'])
            ]);
            Session::flash('alert','Profile dan akun anda sudah di perbarui');
            Session::flash('alert-class','alert-success');
          }else {
            Session::flash('alert','Pastikan password yang anda masukan sama.');
            Session::flash('alert-class','alert-danger');
          }
        }else{
          User::where('id',$id)->update([
            'name' => $data['name']
          ]);
          Session::flash('alert','Profile dan akun anda sudah di perbarui');
          Session::flash('alert-class','alert-success');
        }
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
