<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerasbeliRequest extends FormRequest
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
            'tanggal_berasbeli' => 'required|date',
            'harga_berasbeli' => 'required|regex:/^\d*(\.\d{2})?$/',
            'jumlah_berasbeli' => 'required|regex:/^\d*(\.\d{2})?$/',
            'penjual_berasbeli' => 'required|string'
        ];
    }
}
