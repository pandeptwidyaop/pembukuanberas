@extends('layouts.template')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          TAMBAH PENJUALAN
                      </h2>
                      <ul class="header-dropdown m-r--5">
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="material-icons">more_vert</i>
                              </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('penjualan')}}">Kembali</a></li>

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
                     <div id="message">

                     </div>
                      <form class="form-horizontal" action="{{url('penjualan')}}" method="post" id="formJual">
                        {{csrf_field()}}
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="email_address_2">Tanggal</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" placeholder="Pilih tanggal" name="tanggal_penjualan" required="" id="tanggal_penjualan">
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="p">Pembeli</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="pembeli_penjualan" class="form-control" placeholder="Pembeli" name="pembeli_penjualan" required="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="body table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Barang</th>
                                          <th>Jumlah</th>
                                          <th>Harga</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                    <th colspan="4" class="text-right">Total Belanja</th>
                                    <th class="text-right" id="total_belanja"></th>
                                  </tfoot>
                                  <tbody id="list">

                                  </tbody>
                              </table>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="p">Nama Barang</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                      <select class="form-control show-tick" data-live-search="true" id="barang">
                                          <option value="">Pilih Barang</option>
                                          @foreach ($data as $r)
                                            <option value="{{$r->tipe_barang_gudang}}">{{$r->nama_barang_gudang.' - Stok '.number_format($r->stok_barang_gudang,2,',','.')}} {{($r->tipe_barang_gudang == 'sekam') ? ' truk' : 'kg'}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="jumlah">Jumlah</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" class="form-control" placeholder="Jumlah" id="jumlah">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="">
                                  <button type="button" class="btn btn-primary m-t-15 waves-effect pull-left" onclick="addItem()">Tambah Item</button>
                                  <button type="button" class="btn btn-primary m-t-15 waves-effect pull-right" onclick="submitForm()">Simpan</button>
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
    var totalBelanja = 0;
    function addItem(){
      if (($('#barang').val() != "") && ($('#jumlah').val() != "")) {
        $.ajax({
          url: '{{url('penjualan/barang')}}/'+$('#barang').val(),
          type: 'GET',
          dataType: 'json',
          success : function(msg){
            if (msg.status == false) {
              setMessage('danger',msg.msg);
              clear();
            }else {
              var jumlah = $('#jumlah').val();
              var total = msg.msg.harga * jumlah;
              totalBelanja += total;
              setList(msg.msg.nama,msg.msg.id,jumlah,msg.msg.harga,total,msg.msg.tipe);
              $('#total_belanja').text("Rp. "+number_format(totalBelanja));
              clear();
            }
          }
        });

      }else {
        setMessage('danger','Pastikan barang dan jumlah sudah diisi');
      }
    }

    function setMessage(type,message){
      $('#message').append(
      '<div class="alert alert-'+type+' alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
            message+
      '</div>'
      );
    }

    function setList(nama,id,jumlah,harga,total,tipe){
      $('#list').append(
        '<tr id="'+id+'" data-total="'+total+'">'+
          '<td><div class="btn-group">'+
              '<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'+
                '<span class="caret"></span>'+
              '</button>'+
              '<ul class="dropdown-menu">'+
                '<li><a href="javascript:void(0);" class=" waves-effect waves-block" onclick="removeList('+id+')">Hapus</a></li>'+
              '</ul>'+
          '</div></td>'+
          '<td><input type="hidden" name="item['+id+'][gudang_id]" value="'+id+'">'+nama+'</td>'+
          '<td><input type="hidden" name="item['+id+'][jumlah]" value="'+jumlah+'">'+number_format(jumlah)+((tipe != 'sekam') ? ' kg' : ' truk')+'</td>'+
          '<td><input type="hidden" name="item['+id+'][harga]" value="'+harga+'">Rp.'+number_format(harga)+'</td>'+
          '<td>Rp. '+number_format(total)+'</td>'+
        '</tr>'
      );
    }

    function clear(){
      $('#barang').val("").trigger('change');
      $('#jumlah').val("").trigger('change');
    }

    function removeList(id){
      totalBelanja -= parseInt($('#'+id).data('total'));
      $('#total_belanja').text('Rp. '+number_format(totalBelanja));
      $('#'+id).remove();
    }

    function number_format(nStr) {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }

    function submitForm(){
      if (totalBelanja==0) {
        setMessage('danger','Pastikan anda sudah menambah item.');
      }else {
        $('#formJual').submit();
      }
    }

  </script>
@endsection
