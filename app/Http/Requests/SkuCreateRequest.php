<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|min:0.01',
            'count' => 'required|integer|min:0',
            'product_id' => 'required|integer',
        ];
    }
}
