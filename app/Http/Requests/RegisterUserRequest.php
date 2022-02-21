<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:35'],
            'surname' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
            'phone' => ['required', 'string', new PhoneRule()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
