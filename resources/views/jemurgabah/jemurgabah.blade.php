@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          TAMBAH DATA PENJEMURAN GABAH
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/gabah')}}">Kembali</a></li>

                              </ul>
                          </li>
                      </ul>
                  </div>

                  <div class="body">
                    @if (count($errors) > 0)
                      <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          @foreach ($errors->all() as $r)
                            <li>{{$r}}</li>
                          @endforeach
                      </div>
                    @endif
                      <form class="form-horizontal" action="{{url('gudang/jemurgabah/')}}" method="post">
                          {{csrf_field()}}
                            <div class="row clearfix">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Gabah</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                      <table class="table table-bordered">
                                          <thead>
                                              <tr>
                                                  <th>Pilih</th>
                                                  <th>Kode Gabah</th>
                                                  <th>Tanggal Masuk</th>
                                                  <th>Jumlah Kilogram Gabah</th>
                                                  <th>Jumlah Kampil</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            @php
                                              $ck = 0;
                                            @endphp
                                            @foreach ($data as $r)
                                              @if ($r->tipe_gabah == 'gabah_basah' && count($r->Jemurgabah) == 0 && count($r->Giling) == 0)
                                                <tr>
                                                  <td>
                                                    <input type="checkbox" id="ck{{$ck}}" class="filled-in" name="gabah[]" value="{{$r->id}}" />
                                                    <label for="ck{{$ck}}">Pilih</label></td>
                                                  <td>{{$r->id}}</td>
                                                  <td>{{date('d F Y',strtotime($r->tanggal_masuk_gabah))}}</td>
                                                  <td>{{number_format($r->jumlah_gabah,2,',','.')}} kg</td>
                                                  <td>{{$r->jumlah_kampil}} kampil</td>
                                                </tr>
                                              @endif
                                              @php
                                                $ck++;
                                              @endphp
                                            @endforeach
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="jemur">Tanggal Jemur</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input id="jemur" type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_jemurgabah" required="">
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="kering">Tanggal Kering</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input id="kering" type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_selesai_jemurgabah" required="">
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                                </div>
                            </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
