@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          EDIT SEKAM DARI PENGGILINGAN GABAH
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
                      @foreach ($data as $r)
                        <form class="form-horizontal" action="{{url('gudang/sekam/'.$r->id)}}" method="post">
                          <input type="hidden" name="_method" value="PUT">
                          {{csrf_field()}}
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="email_address_2">Gabah</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                      <select class="form-control show-tick" data-live-search="true" name="gabah_id" id="gabahVal" required="" onchange="countSekam()">
                                        <option value="{{$r->Gabah->id}}" selected="">{{$r->Gabah->id.' - '.date('d F Y',strtotime($r->Gabah->tanggal_masuk_gabah)).' - '.number_format($r->Gabah->jumlah_gabah,2,',','.')}} Kg Gabah - {{number_format($r->Gabah->Beras->jumlah_beras,2,',','.')}} Kg Beras</option>
                                      </select>
                                    </div>
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
                                          <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_masuk_sekam" required="" value="{{date('d F Y',strtotime($r->tanggal_masuk_sekam))}}">
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
                                            <input type="text" id="jmlSekam" class="form-control" placeholder="Jumlah sekam per 10 ton beras" name="jumlah_sekam" required="" value="{{$r->jumlah_sekam}}">
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
                                            <input type="number" id="jml" class="form-control" placeholder="Kampil" name="jumlah_kampil" required="" value="{{$r->jumlah_kampil}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                </div>
                            </div>
                        </form>
                      @endforeach
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
