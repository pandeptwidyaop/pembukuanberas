@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              STOK BARANG GUDANG
              <small></small>
          </h2>
          @if (Session::has('alert'))
            <div class="alert {{Session::get('alert-class')}} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{  Session::get('alert')}}
            </div>
          @endif
      </div>
      <div class="row clearfix">
        @foreach ($data as $r)
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="card">
                  <div class="header bg-green">
                      <h2>
                          {{$r->nama_barang_gudang}} <small>Rp. {{number_format($r->harga_barang_gudang,0,",",".")}} / {{($r->tipe_barang_gudang == 'sekam') ? 'truk' : 'kg'}}</small>
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/stok/'.$r->tipe_barang_gudang.'/edit')}}">Rubah Data</a></li>
                              </ul>
                          </li>
                      </ul>
                  </div>
                  <div class="body">
                    <h2>Stok {{number_format($r->stok_barang_gudang,2,",",".")}} {{($r->tipe_barang_gudang == 'sekam') ? ' ' : 'kg'}}</h2>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
