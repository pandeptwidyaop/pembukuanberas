<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Data Laporan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style media="screen">
      body {
        font-size: 0.8em;
      }
    </style>
  </head>
  <body>
    <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Gabah</th>
          <th>Hasil Giling</th>
          <th>Hasil Sekam</th>
          <th>Hasil Dedak</th>
          <th>Pembelian Gabah</th>
          <th>Penjualan Beras</th>
          <th>Penjualan Dedak</th>
          <th>Penjualan</th>
          <th>Pendapatan Kotor</th>
          <th>Biaya</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php
          $global = 0;
        @endphp
        @foreach ($data as $tanggal => $item)
          @php
            $total_pengeluaran = $total = $count = 0;
          @endphp
          <tr>
            <td>{{$tanggal}}</td>
            <td>{{isset($item->jumlah_gabah) ? number_format($item->jumlah_gabah,0,',','.') : '0'}} kg.</td>
            <td>{{isset($item->jumlah_beras) ? number_format($item->jumlah_beras,0,',','.') : '0'}} kg.</td>
            <td>Rp. {{isset($item->penjualan_sekam) ? number_format($item->penjualan_sekam,0,',','.') : '0'}}</td>
            <td>{{isset($item->jumlah_dedak) ? number_format($item->jumlah_dedak,0,',','.') : '0'}} kg.</td>
            <td>Rp. {{isset($item->beli_gabah) ? number_format($item->beli_gabah,0,',','.') : '0'}}</td>
            <td>Rp. {{isset($item->penjualan_beras) ? number_format($item->penjualan_beras,0,',','.') : '0'}}</td>
            <td>Rp. {{isset($item->penjualan_dedak) ? number_format($item->penjualan_dedak,0,',','.') : '0'}}</td>
            <td>
              @php
                $beras = isset($item->penjualan_beras) ? $item->penjualan_beras : 0;
                $sekam = isset($item->penjualan_sekam) ? $item->penjualan_sekam : 0;
                $dedak = isset($item->penjualan_dedak) ? $item->penjualan_dedak : 0;
                $gabah = isset($item->beli_gabah) ? $item->beli_gabah : 0;
                $pendapatan = ($beras + $sekam + $dedak);
                $kotor = $pendapatan - $gabah;
              @endphp
              Rp. {{number_format($pendapatan,0,',','.')}}
            </td>
            <td>Rp.  {{number_format($kotor,0,',','.')}}</td>
            <td>
              @if (isset($item->pengeluaran))
                @foreach ($item->pengeluaran as $key => $value)
                  @php
                    $tot = $value->harga * $value->banyak;
                    $count += $tot;
                    $total += $tot;
                  @endphp
                  {{$value->nama}} | Rp. {{number_format($tot,0,',','.')}}<br>
                @endforeach
              @endif
              --------------<br>
              TOTAL : Rp. {{number_format($count,0,',','.')}}
            </td>
            <td>
              @php
                $final  = $kotor - $total;
                $global += $final;
              @endphp
              Rp. {{number_format($final,0,',','.')}}
            </td>
          </tr>
          @php
            $count = 0;
          @endphp
        @endforeach
        <tr>
          <td colspan="11" ><p class="pull-right">TOTAL</p></td>
          <td>Rp. {{number_format($global,0,',','.')}}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
