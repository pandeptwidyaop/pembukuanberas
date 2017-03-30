@php
  function bulan($bulan){
    switch ($bulan) {
      case '1':
        return 'Januari';
        break;
      case '2':
        return 'Februari';
        break;
      case '3':
        return 'Maret';
        break;
      case '4':
        return 'April';
        break;
      case '5':
        return 'Mei';
        break;
      case '6':
        return 'Juni';
        break;
      case '7':
        return 'Juli';
        break;
      case '8':
        return 'Agustus';
        break;
      case '9':
        return 'September';
        break;
      case '10':
        return 'Oktober';
        break;
      case '11':
        return 'November';
        break;
      case '12':
        return 'Desember';
        break;
      default :
        break;
    }
  }
@endphp
@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DETAIL BULAN : {{bulan($bulan)}}
          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DETAIL JAM KERJA PEGAWAI
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('kepegawaian/penggajian')}}" onclick="gaji();">Kembali</a></li>
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
                                  <th width="3%"></th>
                                  <th>Nama </th>
                                  <th>Hadir</th>
                                  <th>Total Jam Kerja</th>
                                  <th>Gaji</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th width="3%"></th>
                                <th>Nama </th>
                                <th>Hadir</th>
                                <th>Total Jam Kerja</th>
                                <th>Gaji</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($data as $r)
                              <tr>
                                <th><a href="{{url('kepegawaian/penggajian/detail/bulan/'.$bulan.'/tahun/'.$tahun.'/pegawai/'.$r->id)}}{{($gaji_id != 0) ? "/$gaji_id" : ""}}" type="button" class="btn btn-info btn-xs waves-effect">Detail</a></th>
                                <td>{{$r->nama_pegawai}}</td>
                                <td>{{$r->hadir}}</td>
                                <td>{{$r->jam_kerja}}</td>
                                <td>Rp. {{number_format(($r->jam_kerja * $gaji),2,'.',',')}}</td>

                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <form class="hidden" method="post" id="formHapus">
      <input type="hidden" name="_method" value="DELETE">
      {{csrf_field()}}
    </form>


  </section>
@endsection

@section('js')
  <script type="text/javascript">
    function hapus(id,txt){
        bootbox.confirm({
          message: "Apakah anda ingin menghapus data absen : "+txt+" ?",
          buttons: {
              confirm: {
                  label: 'Hapus',
                  className: 'btn-success'
              },
              cancel: {
                  label: 'Kembali',
                  className: 'btn-danger'
              }
          },
          callback: function (result) {
              if (result) {
                $('#formHapus').attr('action', '{{url('kepegawaian/absen')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });

    }



  </script>
@endsection
