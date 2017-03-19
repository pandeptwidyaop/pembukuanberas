<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StokEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_barang_gudang' => 'required|string',
            'harga_barang_gudang' => 'required|integer',
            'stok_barang_gudang' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function messages(){
      return [
        'nama_barang_gudang.required' => 'Pastikan Nama Barang sudah diisi.',
        'nama_barang_gudang.string' => 'Pastikan anda menginpukan Nama Barang dengan benar.',
        'harga_barang_gudang.required' => 'Pastikan Harga sudah diisi.',
        'harga_barang_gudang.integer' => 'Pastikan anda menginpukan Harga dengan benar.',
        'stok_barang_gudang.required' => 'Pastikan Stok sudah diisi.',
        'stok_barang_gudang.regex' => 'Pastikan anda menginpukan Stok dengan benar.'
      ];
    }


}
