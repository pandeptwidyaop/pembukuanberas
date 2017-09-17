@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DATA DEDAK

          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA DEDAK DARI HASIL PENGGILINGAN GABAH
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/dedak/create')}}">Tambah Dedak</a></li>

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
                                <th>Kode Gabah</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>User</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th></th>
                                <th>Kode Gabah</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>User</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($data as $r)
                              <tr>
                                <th>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li><a href="{{url('gudang/dedak/'.$r->id.'/edit')}}" class=" waves-effect waves-block">Edit</a></li>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block" onclick="hapusDedak({{$r->id}})">Hapus</a></li>
                                      </ul>
                                  </div></th>
                                  <th>
                                    @foreach ($r->Penggilingan->Giling as $giling)
                                      <a href="{{url('gudang/gabah/'.$giling->gabah_id)}}">{{$giling->gabah_id}}</a><br>
                                    @endforeach
                                  </th>
                                  <th>{{date('d F Y',strtotime($r->tanggal_masuk_dedak))}}</th>
                                  <th>{{number_format($r->jumlah_dedak,2,',','.')}} Kg - {{$r->jumlah_kampil}} kampil</th>
                                  <th>{{$r->User->name}}</th>
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
    function hapusDedak(id){
        bootbox.confirm({
          message: "Apakah anda ingin menghapus data dedak : "+id+" ?",
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
                $('#formHapus').attr('action', '{{url('gudang/dedak')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });
    }
  </script>
@endsection
