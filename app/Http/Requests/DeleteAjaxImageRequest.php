<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAjaxImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && is_admin(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image_id' => ['reqired', 'exists:images,id']
        ];
    }
}
