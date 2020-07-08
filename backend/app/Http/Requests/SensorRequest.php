<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'perusahaan_id' => 'required',
            'site_id' => 'required',
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'perusahaan_id' => 'Perusahaan',
            'site_id' => 'Site',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'satuan' => 'Satuan'
        ];
    }
}
