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
@extends('layouts.pdf')
@section('content')
  @foreach ($data as $r)
    <div class="gaji">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12" >
          <h1 class="text-center">SLIP GAJI</h1>
          <h2 class="text-center">{{config('app.name')}}</h2>
        </div>
        <hr>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td width="3%"><b>Nama</b></td>
            <td>{{$r->nama_pegawai}}</td>
          </tr>
          <tr>
            <td><b>Jabatan</b></td>
            <td>-</td>
          </tr>
          <tr>
            <td><b>Alamat</b></td>
            <td>{{$r->alamat}}</td>

          </tr>
          <tr>
            <td><b>Periode</b></td>
            <td>{{bulan($bln).' '.$thn}}</td>
          </tr>
          <tr>
            <td><b>Tanggal</b></td>
            <td>{{date('d-m-Y')}}</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Jumlah Hari</th>
            <th>Jumlah Kerja</th>
            <th>Total Jam Kerja</th>
            <th>Gaji</th>
            <th>Total Gaji</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$r->nama_pegawai}}</td>
            <td>{{$r->total_hari}}</td>
            <td>{{$r->hadir}} Hari</td>
            <td>{{$r->jam_kerja}} Jam</td>
            <td>Rp. {{number_format($gaji[0]->Gaji->gaji,2,',','.')}} / jam</td>
            <td><b>Rp. {{number_format(($gaji[0]->Gaji->gaji * $r->jam_kerja),2,',','.')}}</b></td>
          </tr>
        </tbody>
      </table>
      <br>
      <hr>
      <br>
      <div class="row">
        <div class="col-md-6 col-xs-6 col-lg-6">
          <div class="text-center">
            <p><b>Penerima</b></p>
            <br>
            <br>
            <br>
            <br>
            <p>{{$r->nama_pegawai}}</p>
          </div>
        </div>
        <div class="col-md-6 col-xs-6 col-lg-6">
          <div class="text-center">
            <p><b>{{date('d-m-Y')}}</b></p>
            <br>
            <br>
            <br>
            <br>
            <p>{{config('app.name')}}</p>
          </div>
        </div>
      </div>
    </div>
    <div style="page-break-after: always;"></div>
  @endforeach
@endsection
