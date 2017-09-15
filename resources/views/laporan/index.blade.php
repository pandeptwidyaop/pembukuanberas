@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>
              DATA LAPORAN
          </h2>
      </div>
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          DATA SELURUH LAPORAN
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
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
                    <form action=""="{{url('laporan/data')}}" method="get">
                      <div class="row clearfix">
                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                              <label for="email_address_2">Tanggal Mulai</label>
                          </div>
                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="start" required="">
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="row clearfix">
                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                              <label for="email_address_2">Tanggal Selesai</label>
                          </div>
                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="end" required="">
                                </div>
                            </div>
                          </div>
                      </div>
                      <input type="submit" value="Cari Data" class="btn btn-primary">
                    </form>
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
          message: "Apakah anda ingin menghapus data pengeluaran : "+id+" ?",
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
                $('#formHapus').attr('action', '{{url('pengeluaran')}}/'+id);
                $('#formHapus').submit();
              }
          }
      });
    }
  </script>
@endsection
