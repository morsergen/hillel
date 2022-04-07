<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:35'],
            'surname' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:15', new PhoneRule()],
            'country' => ['required', 'string', 'min:3', 'max:50'],
            'city' => ['required', 'string', 'min:3', 'max:50'],
            'address' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }
}
