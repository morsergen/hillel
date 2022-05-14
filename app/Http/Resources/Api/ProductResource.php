<?php

namespace App\Http\Resources\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /** @var Product $this */

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => CategoryResource::make($this->category),
            'description' => $this->description,
            'sku' => $this->sku,
            'price' => $this->price,
            'discount' => $this->discount,
            'in_stock' => $this->in_stock,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
