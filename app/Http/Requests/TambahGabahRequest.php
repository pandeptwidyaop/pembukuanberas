<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahGabahRequest extends FormRequest
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
            'tanggal_masuk_gabah' => 'required',
            'jumlah_gabah' => 'required|regex:/^\d*(\.\d{2})?$/',
            'penimbang_gabah' => 'required',
            'harga_kiloan_gabah' => 'required|regex:/^\d*(\.\d{2})?$/',
            'nama_penjual_gabah' => 'required',
            'tipe_gabah' => 'required',

        ];
    }

    public function messages(){
      return [
        'tanggal_masuk_gabah.required' => 'Pastikan tanggal sudah diisi.',
        'jumlah_gabah.required' => 'Pastikan jumlah gabah sudah diisi.',
        'jumlah_gabah.regex' => 'Pastikan format harga sudah sesuai.',
        'penimbang_gabah' => 'Pastikan penimbang gabah sudah diisi.',
        'harga_kiloan_gabah.required' => 'Pastikan harga sudah diisi.',
        'harga_kiloan_gabah.regex' => 'Pastikan format harga sudah sesuai.',
        'nama_penjual_gabah.required' => 'Pastikan nama penjual sudah diisi.',
        'tipe_gabah.required' => 'Pastikan tipe gabah sudah diisi.'
      ];
    }
}
