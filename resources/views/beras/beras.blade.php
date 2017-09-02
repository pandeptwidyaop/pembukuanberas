@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DATA BERAS
          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA BERAS DARI GABAH
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/beras/create')}}">Tambah Beras Hasil Giling</a></li>
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
                                <td></td>
                                <td>Kode Gabah</td>
                                <td>Tanggal</td>
                                <td>Jumlah</td>
                                <td>User</td>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <td width="3%"></td>
                                <td>Kode Gabah</td>
                                <td>Tanggal</td>
                                <td>Jumlah</td>
                                <td>User</td>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($data as $r)
                              <tr>
                                <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li><a href="{{url('gudang/beras/'.$r->id.'/edit')}}" class=" waves-effect waves-block">Edit</a></li>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block" onclick="hapusBeras('{{$r->id}}');">Hapus</a></li>
                                      </ul>
                                  </div>
                                </td>
                                <td>
                                  @foreach (json_decode($r->Penggilingan->gabah_id) as $key => $value)
                                    <p><a href="{{url('gudang/gabah/'.$value)}}">{{$value}}</a></p>
                                  @endforeach
                                </td>
                                <td>{{date('d F Y',strtotime($r->tanggal_masuk_beras))}}</td>
                                <td>{{number_format($r->jumlah_beras,2,',','.')}} Kg - {{$r->jumlah_kampil}} kampil</td>
                                <td>{{$r->User->name}}</td>
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
    function hapusBeras(id){
        bootbox.confirm({
          message: "Apakah anda ingin menghapus data beras ini ?",
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
                $('#formHapus').attr('action', '{{url('gudang/beras')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });
    }
  </script>
@endsection
