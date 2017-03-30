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
              BULAN KERJA
          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA BULAN KERJA
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="javascript:void(0);" onclick="gaji();">Setting Gaji</a></li>
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
                                  <th>Bulan </th>
                                  <th>Tahun</th>
                                  <th>Total Hari</th>
                                  <th>Frequensi Hadir</th>
                                  <th>Frequensi Tidak Hadir</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th></th>
                                <th>Bulan </th>
                                <th>Tahun</th>
                                <th>Total Hari</th>
                                <th>Frequensi Hadir</th>
                                <th>Frequensi Tidak Hadir</th>
                                <th>Status</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($data as $r)
                              @php
                              $sts = false;
                                foreach ($status as $s) {

                                  if ($s->bulan == $r->bulan && $s->tahun == $r->tahun) {
                                     $sts = true;
                                  }
                                }
                              @endphp
                              <tr>
                                <th>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li><a href="{{url('kepegawaian/penggajian/bulan/'.$r->bulan.'/tahun/'.$r->tahun)}}" class=" waves-effect waves-block">Lihat</a></li>
                                          <li role="separator" class="divider"></li>
                                          @if ($sts == true)
                                            <li><a href="{{url('generate/slipgaji/'.$r->bulan.'/'.$r->tahun)}}#print" class=" waves-effect waves-block" onclick="">Print Slip Gaji</a></li>
                                          @else
                                            <li><a href="{{url('kepegawaian/penggajian/proses/bulan/'.$r->bulan.'/tahun/'.$r->tahun)}}" class=" waves-effect waves-block" onclick="">Proses Gaji</a></li>
                                          @endif
                                      </ul>
                                  </div>
                                </th>
                                <td>{{bulan($r->bulan)}}</td>
                                <td>{{$r->tahun}}</td>
                                <td>{{$r->total_hari}}</td>
                                <td>{{$r->total_hadir}} x</td>
                                <td>{{$r->total_absen}} x</td>
                                <td>
                                  @if ($sts == true)
                                    <span class="label label-success">Sudah Digaji</span>
                                  @else
                                    <span class="label label-warning">Belum Digaji</span>
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

    <form class="hidden" method="post" id="formHapus">
      <input type="hidden" name="_method" value="DELETE">
      {{csrf_field()}}
    </form>

    <form class="hidden" method="post" id="formGaji">
      {{csrf_field()}}
      <input type="text" name="gaji" value="" id="txtGaji">
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

      function gaji(){
        $.ajax({
          url: '{{url('kepegawaian/gaji')}}',
          type: 'GET',
          dataType: 'json',
          success : function(m){
            bootbox.prompt({
              title : "Jumlah gaji per jam.",
              value : m.gaji,
              callback : function (result) {
                if (result != null) {
                  $('#formGaji').attr('action', '{{url('kepegawaian/gaji')}}');
                  $('#txtGaji').val(result);
                  $('#formGaji').submit();
                }
              }
            });
          }
        });
      }


  </script>
@endsection
