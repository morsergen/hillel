<?php

namespace App\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** @var Product $product */
        $product = $this->route('product');

        return [
            'product_count' => ['required', 'integer', 'min:1', 'max:' . $product->in_stock],
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
       /** @var Product $product */
       $product = $this->route('product');

       return [
           'product_count.max' => 'The product "' . $product->title . '" has only ' . $product->in_stock . ' items',
       ];
    }
}
