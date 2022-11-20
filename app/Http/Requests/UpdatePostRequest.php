<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'sometimes', 'string',
            'title_en' => 'sometimes', 'string',
            'body' => 'sometimes', 'string',
            'body_en' => 'sometimes', 'string',
            'image' =>'sometimes|image|mimes:jpeg,png,jpg|max:1048',
        ];
    }
}
