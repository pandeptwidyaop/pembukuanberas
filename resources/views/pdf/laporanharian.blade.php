
@extends('layouts.pdf')
@section('content')
  <div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12">
      <div class="text-center">
        <h1>LAPORAN HARIAN</h1>
        <h2>{{config('app.name')}}</h2>
        <h4>TANGGAL {{date('d-m-Y',strtotime($now))}}</h4>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2" class="text-center"><b>LAPORAN GUDANG</b></th>
          </tr>
          <tr>
            <th>Nama Barang</th>
            <th>Sisa Stok</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($gudang as $r)
            <tr>
              <td>{{$r->nama_barang_gudang}}</td>
              <td>{{$r->stok_barang_gudang}} {{($r->tipe_barang_gudang == 'sekam') ? 'truk' : 'kg'}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered ">
        <thead>
          <tr>
            <th colspan="8" class="text-center"><b>LAPORAN GABAH</b></th>
          </tr>
          <tr>
            <th>Kode Gabah</th>
            <th>Penjual</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Tipe</th>
            <th>Status</th>
            <th>Penimbang</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($gabah as $r)
            <tr>
              <td>{{$r->id}}</td>
              <td>{{$r->nama_penjual_gabah}}</td>
              <td>{{number_format($r->jumlah_gabah,2,',','.')}} Kg</td>
              <td>Rp. {{number_format($r->harga_kiloan_gabah,2,',','.')}}</td>
              <td>Rp. {{number_format(($r->harga_kiloan_gabah * $r->jumlah_gabah),2,',','.')}}</td>
              <td>{{($r->tipe_gabah == 'gabah_basah') ? 'GABAH BASAH' : 'GABAH KERING'}}</td>
              <td>
                @if ($r->tipe_gabah == 'gabah_basah')
                  @if (count($r->Jemurgabah) == 1)
                    Dijemur
                  @else
                    Belum Dijemur
                  @endif
                  @if (count($r->Giling) == 1)
                    Digiling
                  @else
                  Belum Digiling
                  @endif
                @else
                  @if (count($r->Giling) == 1)
                    Digiling
                  @else
                    Belum Digiling
                  @endif
                @endif
              </td>
              <td>{{$r->penimbang_gabah}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="4" class="text-center"><b>LAPORAN BERAS DARI GABAH</b></th>
          </tr>
          <tr>
            <th>Kode Gabah</th>
            <th>Jumlah Gabah</th>
            <th>Jumlah Beras</th>
            <th>Persentase</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($berasgabah as $r)
            <tr>
              <td>{{$r->Gabah->id}}</td>
              <td>{{number_format($r->Gabah->jumlah_gabah,2,',','.')}} Kg</td>
              <td>{{number_format($r->jumlah_beras,2,',','.')}} Kg</td>
              <td>{{($r->jumlah_beras / $r->Gabah->jumlah_gabah) * 100 }}%</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="4" class="text-center"><b>LAPORAN BERAS DARI PEMBELIAN</b></th>
          </tr>
          <tr>
            <th>Penjual</th>
            <th>Jumlah Beras</th>
            <th>Harga Beras</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($berasbeli as $r)
            <tr>
              <td>{{$r->penjual_berasbeli}}</td>
              <td>{{number_format($r->jumlah_berasbeli,2,',','.')}} Kg</td>
              <td>Rp. {{number_format($r->harga_berasbeli,2,',','.')}}</td>
              <td>Rp. {{number_format(($r->jumlah_berasbeli * $r->harga_berasbeli),2,',','.')}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3" class="text-center"><b>LAPORAN SEKAM</b></th>
          </tr>
          <tr>
            <th>Kode Gabah</th>
            <th>Jumlah Gabah</th>
            <th>Jumlah Sekam</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sekam as $r)
            <tr>
              <td>{{$r->Gabah->id}}</td>
              <td>{{number_format($r->Gabah->jumlah_gabah,2,',','.')}} Kg.</td>
              <td>{{number_format($r->jumlah_sekam,2,',','.')}} truk</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3" class="text-center"><b>LAPORAN DEDAK</b></th>
          </tr>
          <tr>
            <th>Kode Gabah</th>
            <th>Jumlah Gabah</th>
            <th>Jumlah Dedak</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dedak as $r)
            <tr>
              <td>{{$r->Gabah->id}}</td>
              <td>{{number_format($r->Gabah->jumlah_gabah,2,',','.')}} Kg</td>
              <td>{{number_format($r->jumlah_dedak,2,',','.')}} Kg</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="4" class="text-center"><b>LAPORAN PENJUALAN</b></th>
          </tr>
          <tr>
            <th>Pembeli</th>
            <th>Barang</th>
            <th>Total</th>
            <th>Kasir</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penjualan as $r)
            <tr>
              <td>{{$r->pembeli_penjualan}}</td>
              <td>
                @foreach ($r->Penjualanitem as $p)
                  <p>{{$p->Gudang->nama_barang_gudang.' - '.number_format($p->jumlah,2,',','.')}} {{($p->Gudang->tipe_barang_gudang == 'sekam') ? 'truk' : 'kg'}} {{'@Rp. '.number_format($p->harga,2,',','.')}}</p>
                @endforeach
              </td>
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
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3" class="text-center"><b>LAPORAN PEGAWAI</b></th>
          </tr>
          <tr>
            <th>Nama Pegawai</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($absen as $ka)
            @foreach ($ka->Kehadiran as $r)
              <tr>
                <td>{{$r->Pegawai->nama_pegawai}}</td>
                @if ($r->absen_masuk == 1)
                  <td>{{date('H:m:s',strtotime($r->waktu_masuk))}}</td>
                  <td>{{date('H:m:s',strtotime($r->waktu_keluar))}}</td>
                @else
                  <td>-</td>
                  <td>-</td>
                @endif
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
      <br>
      <br>
      <hr>

    </div>
    <div class="col-md-3 col-lg-3 col-xs-3 col-md-offset-8 col-xs-offset-8 col-lg-offset-8 text-center">
      <p><b>BADUNG, {{date('m-d-Y',strtotime($now))}}</b></p>
      <p><b>PELAPOR</b></p>
      <br>
      <br>
      <br>
      <p>{{Auth::user()->name}}</p>
    </div>
  </div>
  <br>
  <br>
@endsection
