@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DATA PENJUALAN

          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA SEMUA PENJUALAN
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('penjualan/create')}}">Tambah Penjualan</a></li>

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
                                  <th>Nota</th>
                                  <th>Tanggal</th>
                                  <th>Item</th>
                                  <th>Pembeli</th>
                                  <th>Total</th>
                                  <th>Kasir</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th width="3%"></th>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Item</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Kasir</th>
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
                                          <li><a href="{{url('penjualan/'.$r->id)}}" class=" waves-effect waves-block" >Print Nota</a></li>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block" onclick="hapus({{$r->id}})">Hapus</a></li>

                                      </ul>
                                  </div>
                                </td>
                                <td><a href="{{url('penjualan/'.$r->id)}}">{{$r->id}}</a></td>
                                <td>{{date('d F Y',strtotime($r->tanggal_penjualan))}}</td>
                                <td>
                                  @foreach ($r->Penjualanitem as $p)
                                    <p>{{$p->Gudang->nama_barang_gudang.' - '.number_format($p->jumlah,2,',','.')}} {{($p->Gudang->tipe_barang_gudang == 'sekam') ? 'truk' : 'kg'}} {{'@Rp. '.number_format($p->harga,2,',','.')}}</p>
                                  @endforeach
                                </td>
                                <td>{{$r->pembeli_penjualan}}</td>
                                <td>
                                  @php
                                  $count = 0;
                                  foreach ($r->Penjualanitem as $p) {
                                    $count +=($p->harga * $p->jumlah);
                                  }
                                  @endphp
                                  {{'Rp. '.number_format($count,2,',','.')}}
                                </td>
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
    function hapus(id){
        bootbox.confirm({
          message: "Apakah anda ingin menghapus data penjualan nota : "+id+" ?",
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
                $('#formHapus').attr('action', '{{url('penjualan')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });
    }
  </script>
@endsection
