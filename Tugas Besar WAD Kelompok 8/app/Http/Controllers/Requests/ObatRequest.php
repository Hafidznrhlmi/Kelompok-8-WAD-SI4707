<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'nullable|string',
        ];
    }
}
