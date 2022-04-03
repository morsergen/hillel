<?php

namespace App\Http\Requests\Cart;

use App\Rules\CheckExistsRowIdInCart;
use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'row_id' => ['required', new CheckExistsRowIdInCart()],
        ];
    }
}
