@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          TAMBAH USER
                      </h2>

                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('/users')}}">Kembali</a></li>
                              </ul>
                          </li>
                      </ul>

                  </div>
                  <div class="body">
                    @if (Session::has('alert'))
                      <div class="alert {{Session::get('alert-class')}} alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          {{  Session::get('alert')}}
                      </div>
                    @endif
                      <form action="{{url('/users')}}" method="POST">
                        {{csrf_field()}}
                          <label for="email_address">Username</label>
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="text" id="email_address" class="form-control" placeholder="Masukan username" name="username" required="">
                              </div>
                          </div>
                          <label for="nama">Nama</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="name" placeholder="Masukan nama" required="">
                            </div>
                          </div>
                          <label for="password">Password</label>
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="password" id="password" class="form-control" placeholder="Masukan password" name="password" required="">
                              </div>
                          </div>
                          <label for="password2">Retype Password</label>
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="password" id="password2" class="form-control" placeholder="Masukan password lagi" name="password2" required="">
                              </div>
                          </div>
                        
                          <br>
                          <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
