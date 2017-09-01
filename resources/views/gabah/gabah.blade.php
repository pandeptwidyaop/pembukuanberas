@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DATA GABAH

          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA GABAH BASAH DAN KERING
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/gabah/create')}}">Tambah Gabah</a></li>
                                  <li><a href="{{url('gudang/jemurgabah')}}">Jemur Gabah</a></li>
                                  <li><a href="{{url('gudang/giling')}}">Giling Gabah</a></li>
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
                                  <th>Kode</th>
                                  <th>Tanggal</th>
                                  <th>Penjual</th>
                                  <th>Jumlah</th>
                                  <th>Harga</th>
                                  <th>Total</th>
                                  <th>Jenis</th>
                                  <th>Penimbang</th>
                                  <th>Status</th>

                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Penjual</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Jenis</th>
                                <th>Penimbang</th>
                                <th>Status</th>

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
                                          <li><a href="{{url('gudang/gabah/'.$r->id.'/edit')}}" class=" waves-effect waves-block">Edit</a></li>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block" onclick="hapusGabah({{$r->id}})">Hapus</a></li>
                                      </ul>
                                  </div></th>
                                <th><a href="{{url('gudang/gabah/'.$r->id)}}">{{$r->id}}</a></th>
                                <th>{{date('d F Y', strtotime($r->tanggal_masuk_gabah))}}</th>
                                <th>{{$r->nama_penjual_gabah}}</th>
                                <th>{{number_format($r->jumlah_gabah,2,',','.')}} kg - {{$r->jumlah_kampil}} kampil</th>
                                <th>Rp. {{number_format($r->harga_kiloan_gabah,0,',','.')}}</th>
                                <th>Rp. {{number_format(($r->jumlah_gabah * $r->harga_kiloan_gabah),2,',','.')}}</th>
                                <th>{!!($r->tipe_gabah == 'gabah_basah') ? '<span class="label label-success">Basah</span>' : '<span class="label label-danger">Kering</span>'!!}</th>
                                <th>{{$r->penimbang_gabah}}</th>
                                <th>
                                  @if ($r->tipe_gabah == 'gabah_basah')

                                    @if (count($r->Jemurgabah) == 1)
                                      <span class="label label-primary">Dijemur</span>
                                    @else
                                      <span class="label label-default">Belum Dijemur</span>
                                    @endif
                                    @if (count($r->Giling) == 1)
                                      <span class="label label-success">Digiling</span>
                                    @else
                                      <span class="label label-default">Belum Digiling</span>
                                    @endif
                                  @else
                                    @if (count($r->Giling) == 1)
                                      <span class="label label-success">Digiling</span>
                                    @else
                                      <span class="label label-default">Belum Digiling</span>
                                    @endif
                                  @endif
                                </th>

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
    function hapusGabah(id){
        bootbox.confirm({
          message: "Apakah anda ingin menghapus data gabah : "+id+" ?",
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
                $('#formHapus').attr('action', '{{url('gudang/gabah')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });
    }
  </script>
@endsection
