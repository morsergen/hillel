<?php

namespace App\Http\Requests\Account;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name' => ['string', 'min:3', 'max:35'],
            'surname' => ['string', 'min:3', 'max:50'],
            'email' => ['email', 'unique:users,email,' . auth()->user()->id],
            'birthdate' => ['date'],
            'phone' => ['string', 'max:15', new PhoneRule(), 'unique:users,email,' . auth()->user()->id],
            'balance' => ['numeric'],
        ];
    }
}
