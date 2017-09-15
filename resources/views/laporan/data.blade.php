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
          <th>Pendapatan Penjualan</th>
          <th>Biaya</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $tanggal => $item)
          @php
            $total_pengeluaran = $total = $count = 0;
          @endphp
          <tr>
            <td>{{$tanggal}}</td>
            <td>{{isset($item->jumlah_gabah) ? $item->jumlah_gabah : '0'}} kg.</td>
            <td>{{isset($item->jumlah_beras) ? $item->jumlah_beras : '0'}} kg.</td>
            <td>Rp. {{isset($item->penjualan_sekam) ? $item->penjualan_sekam : '0'}}</td>
            <td>{{isset($item->jumlah_dedak) ? $item->jumlah_dedak : '0'}} kg.</td>
            <td>Rp. {{isset($item->beli_gabah) ? $item->beli_gabah : '0'}}</td>
            <td>Rp. {{isset($item->penjualan_beras) ? $item->penjualan_beras : '0'}}</td>
            <td>Rp. {{isset($item->penjualan_dedak) ? $item->penjualan_dedak : '0'}}</td>
            <td>
              @php
                $beras = isset($item->penjualan_beras) ? $item->penjualan_beras : 0;
                $sekam = isset($item->penjualan_sekam) ? $item->penjualan_sekam : 0;
                $dedak = isset($item->penjualan_dedak) ? $item->penjualan_dedak : 0;
                $gabah = isset($item->beli_gabah) ? $item->beli_gabah : 0;
                $pendapatan = ($beras + $sekam + $dedak) - $gabah;
              @endphp
            Rp.  {{$pendapatan}}
            </td>
            <td>
              @if (isset($item->pengeluaran))
                @foreach ($item->pengeluaran as $key => $value)
                  @php
                    $tot = $value->harga * $value->banyak;
                    $count += $tot;
                    $total += $tot;
                  @endphp
                  {{$value->nama}} | Rp. {{$tot}}<br>
                @endforeach
              @endif
              TOTAL : Rp. {{$count}}
            </td>
            <td>
              @php
                $final  = $pendapatan - $total;
              @endphp
              Rp. {{$final}}
            </td>
          </tr>
          @php
            $count = 0;
          @endphp
        @endforeach
      </tbody>
    </table>
  </body>
</html>
