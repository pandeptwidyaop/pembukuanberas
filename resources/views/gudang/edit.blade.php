@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        @foreach ($data as $r)
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          RUBAH DATA {{$r->nama_barang_gudang}}
                      </h2>
                  </div>

                  <div class="body">
                      @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <ul>
                              @foreach ($errors->all() as $e)
                                <li>{{$e}}</li>
                              @endforeach
                            </ul>
                        </div>
                      @endif
                      <form class="form-horizontal" action="{{url('gudang/stok/'.$r->tipe_barang_gudang)}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="put">
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="nama">Nama Barang</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input id="nama" name="nama_barang_gudang" class="form-control" placeholder="" type="text" value="{{$r->nama_barang_gudang}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="harga">Harga</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input id="harga" name="harga_barang_gudang" class="form-control" placeholder="" type="number" value="{{$r->harga_barang_gudang}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="harga">Jumlah Stok</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input id="harga" name="stok_barang_gudang" class="form-control" placeholder="" type="text" value="{{$r->stok_barang_gudang}}">
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
        @endforeach
      </div>
    </div>
  </section>
@endsection
