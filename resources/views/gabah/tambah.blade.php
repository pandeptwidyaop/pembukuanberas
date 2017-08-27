@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          TAMBAH GABAH
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
                      <form class="form-horizontal" action="{{url('gudang/gabah')}}" method="post">
                        {{csrf_field()}}
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="email_address_2">Tanggal</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_masuk_gabah" required="">
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="p">Penimbang</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="p" class="form-control" placeholder="Penimbang" name="penimbang_gabah" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="h">Harga</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="h" class="form-control" placeholder="Harga per Kilogram" name="harga_kiloan_gabah" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="n">Penjual</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="n" class="form-control" placeholder="Penjual" name="nama_penjual_gabah" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="jml">Jumlah</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="jml" class="form-control" placeholder="Kilogram" name="jumlah_gabah" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="jml">Tipe Gabah</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                  <div class="form-line">
                                    <select class="form-control show-tick" required="" name="tipe_gabah" width="100%">
                                      <option value="">Pilih</option>
                                      <option value="gabah_kering">KERING</option>
                                      <option value="gabah_basah">BASAH</option>
                                    </select>
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
