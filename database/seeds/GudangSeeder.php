<?php

use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gudangs')->insert([
          [
            'nama_barang_gudang' => 'GABAH BASAH',
            'stok_barang_gudang' => 0,
            'harga_barang_gudang' => 10000,
            'tipe_barang_gudang' => 'gabah_basah',
            'user_id' => 1
          ],
          [
            'nama_barang_gudang' => 'GABAH KERING',
            'stok_barang_gudang' => 0,
            'harga_barang_gudang' => 10000,
            'tipe_barang_gudang' => 'gabah_kering',
            'user_id' => 1
          ],
          [
            'nama_barang_gudang' => 'BERAS',
            'stok_barang_gudang' => 0,
            'harga_barang_gudang' => 10000,
            'tipe_barang_gudang' => 'beras',
            'user_id' => 1
          ],
          [
            'nama_barang_gudang' => 'SEKAM',
            'stok_barang_gudang' => 0,
            'harga_barang_gudang' => 10000,
            'tipe_barang_gudang' => 'sekam',
            'user_id' => 1
          ],
          [
            'nama_barang_gudang' => 'DEDAK',
            'stok_barang_gudang' => 0,
            'harga_barang_gudang' => 10000,
            'tipe_barang_gudang' => 'dedak',
            'user_id' => 1
          ],
        ]);
    }
}
