<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'key' => 'required',
            'name_en' => 'sometimes|string',
            'address' => 'sometimes|string',
            'key_en' => 'required',
            'address_en' => 'required',
            'description' => 'required',
            'description_en' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'map' => 'required',
        ];
    }
}
