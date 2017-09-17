@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          TAMBAH SEKAM DARI PENGGILINGAN GABAH
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('gudang/sekam')}}">Kembali</a></li>

                              </ul>
                          </li>
                      </ul>
                  </div>

                  <div class="body">
                    @if (count($errors) > 0)
                      <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          @foreach ($errors->all() as $r)
                            <li>{{$r}}</li>
                          @endforeach
                      </div>
                    @endif
                      <form class="form-horizontal" action="{{url('gudang/sekam')}}" method="post">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">Gabah</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                              <div class="form-group">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <td>Pilih</td>
                                      <td>Tanggal Giling</td>
                                      <td>Kode Gabah</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                      $ck=0;
                                    @endphp
                                    @foreach ($penggilingans as $penggilingan)
                                      <tr>
                                        <td>
                                          <input type="checkbox" id="ck{{$ck}}" class="filled-in" name="penggilingan_id[]" value="{{$penggilingan->id}}">
                                          <label for="ck{{$ck}}">Pilih</label>
                                        </td>
                                        <td>{{date('d F Y',strtotime($penggilingan->tanggal_giling))}}</td>
                                        <td>
                                          @foreach ($penggilingan->Giling as $giling)
                                            <a href="{{url('gudang/gabah/'.$giling->gabah_id)}}">{{$giling->gabah_id}}</a><br>
                                          @endforeach
                                        </td>
                                      </tr>
                                      @php
                                        $ck++;
                                      @endphp
                                    @endforeach
                                    @if (count($penggilingans) == 0)
                                      <td colspan="3">Tidak ada data</td>
                                    @endif
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="email_address_2">Tanggal</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_masuk_sekam" required="">
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="jmlSekam">Jumlah</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="jmlSekam" class="form-control" placeholder="Jumlah sekam" name="jumlah_sekam" required="">
                                      </div>
                                      <small id="keterangan"></small>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="jml">Jumlah Kampil</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="number" id="jml" class="form-control" placeholder="Kampil" name="jumlah_kampil" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
@section('js')
  <script type="text/javascript">
    function countSekam(){
      var id = $('#gabahVal').val();
      $.ajax({
        url: '{{url('gudang/sekam/count')}}/'+id,
        type: 'GET',
        dataType: 'JSON',
        success : function(msg){
          $('#jmlSekam').val(msg.hasil);
          $('#keterangan').text(msg.ket);
        }
      });

    }
  </script>
@endsection
