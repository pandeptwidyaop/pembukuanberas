<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Gudang;
use App\Gabah;
use App\Beras;
use App\Berasbeli;
use App\Sekam;
use App\Dedak;
use App\Penjualan;
use App\Absen;
use App\Pengeluaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $data = [];

    public function harian(){
      $now = date('Y-m-d',strtotime(Carbon::now('Asia/Jakarta')));
      $gudang = Gudang::all();
      $gabah = Gabah::where("tanggal_masuk_gabah", "=",$now)->get();
      $berasgabah = Beras::where("tanggal_masuk_beras","=",$now)->get();
      $berasbeli = Berasbeli::where("tanggal_berasbeli","=",$now)->get();
      $sekam = Sekam::where("tanggal_masuk_sekam","=",$now)->get();
      $dedak = Dedak::where("tanggal_masuk_dedak","=",$now)->get();
      $penjualan = Penjualan::where("tanggal_penjualan","=",$now)->get();
      $absen = Absen::where("tanggal","=",$now)->get();
      return view('pdf.laporanharian',compact('now','gudang','gabah','berasgabah','berasbeli','sekam','dedak','penjualan','absen'));
    }

    public function data(Request $request)
    {
      if ($request->start == null && $request->end == null) {
        return view('laporan.index');
      }else {
        $start = date('Y-m-d',strtotime($request->start));
        $end = date('Y-m-d',strtotime($request->end));
        $data = json_decode($this->getAllData($start,$end));
        // dd($data);
        return view('laporan.data', compact('data'));
      }
    }

    public function getAllData($start,$end)
    {
      $gabah = Gabah::whereBetween('tanggal_masuk_gabah',[$start,$end])->get()->groupBy('tanggal_masuk_gabah');
      $beras = Beras::whereBetween('tanggal_masuk_beras',[$start,$end])->get()->groupBy('tanggal_masuk_beras');
      $sekam = Sekam::whereBetween('tanggal_masuk_sekam',[$start,$end])->get()->groupBy('tanggal_masuk_sekam');
      $dedak = Dedak::whereBetween('tanggal_masuk_dedak',[$start,$end])->get()->groupBy('tanggal_masuk_dedak');
      $penjualan = Penjualan::whereBetween('tanggal_penjualan',[$start,$end])->get()->groupBy('tanggal_penjualan');
      $pengeluaran  = Pengeluaran::whereBetween('tanggal',[$start,$end])->get()->groupBy('tanggal');
      $data = [];
      /**
       * Untuk Gabah
       * @var
       */
      foreach ($gabah as $tanggal => $data_gabah) {
        $total_gabah = $beli_gabah = 0;
        foreach ($data_gabah as $key => $value) {
          $total_gabah += $value->jumlah_gabah;
          $beli_gabah += ($value->jumlah_gabah * $value->harga_kiloan_gabah);
        }
        $data[$tanggal]['jumlah_gabah'] = $total_gabah;
        $data[$tanggal]['beli_gabah'] = $beli_gabah;
      }
      /**
       * Untuk Beras
       * @var [type]
       */
      foreach ($beras as $tanggal => $data_beras) {
        $jumlah = 0;
        foreach ($data_beras as $key => $value) {
          $jumlah += $value->jumlah_beras;
        }
        $data[$tanggal]['jumlah_beras'] = $jumlah;
      }
      /**
       * Untuk Sekam
       * @var [type]
       */
      foreach ($sekam as $tanggal => $data_sekam) {
        $jumlah = 0;
        foreach ($data_sekam as $key => $value) {
          $jumlah += $value->jumlah_sekam;
        }
        $data[$tanggal]['jumlah_sekam'] = $jumlah;
      }
      /**
       * Untuk Dedak
       * @var [type]
       */
      foreach ($dedak as $tanggal => $data_dedak) {
        $jumlah = 0;
        foreach ($data_dedak as $key => $value) {
          $jumlah += $value->jumlah_dedak;
        }
        $data[$tanggal]['jumlah_dedak'] = $jumlah;
      }
      /**
       * Untuk Penjualan
       * @var [type]
       */
      foreach ($penjualan as $tanggal => $data_penjualan) {
        $jumlahberas = $jumlahdedak = $jumlahsekam = 0;
        foreach ($data_penjualan as $key => $value) {
          foreach ($value->Penjualanitem as $barang) {
            if ($barang->Gudang->tipe_barang_gudang == 'beras') {
              $jumlahberas += ($barang->jumlah * $barang->harga);
            }elseif ($barang->Gudang->tipe_barang_gudang == 'sekam') {
              $jumlahsekam += ($barang->jumlah * $barang->harga);
            }elseif ($barang->Gudang->tipe_barang_gudang == 'dedak') {
              $jumlahdedak += ($barang->jumlah * $barang->harga);
            }
          }
        }
        $data[$tanggal]['penjualan_beras'] = $jumlahberas;
        $data[$tanggal]['penjualan_dedak'] = $jumlahdedak;
        $data[$tanggal]['penjualan_sekam'] = $jumlahsekam;
      }

      foreach ($pengeluaran as $tanggal => $data_pengeluaran) {
        $data[$tanggal]['pengeluaran'] = $data_pengeluaran;
      }
      return json_encode($data);
    }

}
