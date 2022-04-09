<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRatingRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function add(AddRatingRequest $addRatingRequest, Product $product): RedirectResponse
    {
        $product->rateOnce($addRatingRequest->validated()['star']);
        return redirect()->back()->with('success', __('Thanks for your rating'));
    }
}
