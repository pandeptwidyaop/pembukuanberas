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
                          EDIT ABSENSI : {{date('d-m-Y',strtotime($abs->tanggal))}} - {{$data->Pegawai->nama_pegawai}}
                      </h2>

                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('kepegawaian/absen/absensi/'.$absen)}}">Kembali</a></li>
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
                    <div class="row">
                      <form class="form-horizontal" action="{{url('kepegawaian/absen/absensi/'.$absen.'/'.$data->id.'/edit')}}" method="post">
                          <input type="hidden" name="_method" value="PUT">
                          {{csrf_field()}}
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="email_address_2">Waktu Masuk</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="email_address_2" class="timepicker form-control" name="waktu_masuk" value="{{date('H:i',strtotime($data->waktu_masuk))}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="password_2">Waktu Keluar</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="password_2" class="timepicker form-control" name="waktu_keluar" value="{{date('H:i',strtotime($data->waktu_keluar))}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
