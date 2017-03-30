@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              ABSENSI PEGAWAI TANGGAL {{date('d-m-Y',strtotime($date))}}
          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA ABSENSI MASUK & KELUAR PEGAWAI
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('kepegawaian/absen')}}">Kembali</a></li>
                              </ul>
                          </li>
                      </ul>
                  </div>
                  <div class="body">
                    @if (Session::has('alert'))
                      <div class="alert {{Session::get('alert-class')}} alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          {{Session::get('alert')}}
                      </div>
                    @endif
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Absen Masuk</th>
                                <th>Absen Keluar</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Nama</th>
                              <th>Absen Masuk</th>
                              <th>Absen Keluar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($data as $r)
                            <tr>
                              <td>{{$r->Pegawai->nama_pegawai}}</td>
                              <td>
                                @if ($r->absen_masuk == 0)
                                  <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="absen({{$r->id}},'masuk')">
                                      <i class="material-icons">create</i>
                                  </button>
                                  <span class="label label-warning">Belum Absen</span>
                                @else
                                  <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                      <i class="material-icons">check</i>
                                  </button>
                                  <span class="label label-success">{{date('H:i:s',strtotime($r->waktu_masuk))}}</span>
                                @endif
                              </td>
                              <td>
                                @if ($r->absen_keluar == 0)
                                  <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="absen({{$r->id}},'keluar')">
                                      <i class="material-icons">create</i>
                                  </button>
                                  <span class="label label-warning">Belum Absen</span>
                                @else
                                  <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                      <i class="material-icons">check</i>
                                  </button>
                                  <span class="label label-success">{{date('H:i:s',strtotime($r->waktu_keluar))}}</span>
                                @endif
                              </td>

                            </tr>
                          @endforeach
                        </tbody>
                    </table>

                  </div>
                </div>

          </div>
      </div>
    </div>
    <form class="hidden" method="post" id="formAbsen">

      {{csrf_field()}}
    </form>
  </section>
@endsection

@section('js')
  <script type="text/javascript">
    function absen(id,tipe){
      $('#formAbsen').attr('action', "{{url('kepegawaian/absen/absensi/'.$id)}}/set/"+id+"/"+tipe);
      $('#formAbsen').submit();
    }
  </script>
@endsection
