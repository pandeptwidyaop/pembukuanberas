@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA SPESIFIK GABAH KODE : {{$data_gabah[0]->id}}

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
                  <div class="body table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Kode</th>
                                  <th>Tanggal</th>
                                  <th>Jumlah</th>
                                  <th>Penjual</th>
                                  <th>Penimbang</th>
                                  <th>Harga</th>
                                  <th>Total</th>
                                  <th>Tipe</th>
                                  <th>User Name</th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                              @foreach ($data_gabah as $r)
                                <td>{{$r->id}}</td>
                                <td>{{date('d F Y', strtotime($r->tanggal_masuk_gabah))}}</td>
                                <td>{{number_format($r->jumlah_gabah,2,',','.')}}</td>
                                <td>{{$r->nama_penjual_gabah}}</td>
                                <td>{{$r->penimbang_gabah}}</td>
                                <td>Rp. {{number_format($r->harga_kiloan_gabah,2,',','.')}}</td>
                                <td>Rp .{{number_format(($r->jumlah_gabah * $r->harga_kiloan_gabah),2,',','.')}}</td>
                                <td>{{($r->tipe_gabah == 'gabah_kering') ? 'KERING' : 'BASAH'}}</td>
                                <td>{{$r->User->name}}</td>
                              @endforeach
                            </tr>
                          </tbody>
                      </table>

                      @if ($data_gabah[0]->tipe_gabah == 'gabah_basah')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal Jemur</th>
                                    <th>Tanggal Kering</th>
                                    <th>User Name</th>

                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                @foreach ($data_jemur as $r)
                                  <td>{{$r->gabah_id}}</td>
                                  <td>{{date('d F Y', strtotime($r->tanggal_jemurgabah))}}</td>
                                  <td>{{date('d F Y', strtotime($r->tanggal_selesai_jemurgabah))}}</td>
                                  <td>{{$r->User->name}}</td>
                                @endforeach
                              </tr>
                            </tbody>
                        </table>
                      @endif

                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Kode</th>
                                  <th>Tanggal Giling</th>
                                  <th>User Name</th>

                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                              @foreach ($data_giling as $r)
                                <td>{{$r->gabah_id}}</td>
                                <td>{{date('d F Y', strtotime($r->tanggal_giling))}}</td>
                                <td>{{$r->User->name}}</td>
                              @endforeach
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
