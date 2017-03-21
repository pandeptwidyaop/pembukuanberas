<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GabahRequest extends FormRequest
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
            'tanggal_masuk_gabah' => 'required|date',
            'jumlah_gabah' => 'required|regex:/^\d*(\.\d{2})?$/',
            'penimbang_gabah' => 'required',
            'harga_kiloan_gabah' => 'required|regex:/^\d*(\.\d{2})?$/',
            'nama_penjual_gabah' => 'required',
            'tipe_gabah' => 'required'
        ];
    }
}
