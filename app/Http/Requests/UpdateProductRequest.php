<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:255', 'unique:products,title,' . $this->id],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'sku' => ['required', 'string', 'min:1', 'max:255', 'unique:products,sku,' . $this->id],
            'price' => ['required', 'numeric', 'min:1'],
            'discount' => ['required', 'numeric', 'min:0', 'max:99'],
            'in_stock' => ['required', 'numeric'],
            'short_description' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['required', 'string', 'min:10'],
            'thumbnail' => ['image:jpeg,png'],
            'images' => ['array', 'max:6'],
            'images.*' => ['image:jpeg,png'],
        ];
    }
}
