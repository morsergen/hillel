<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteAjaxImageRequest;
use App\Models\Image;
use Illuminate\Http\JsonResponse;

class DeleteImageController extends Controller
{
    public function __invoke(DeleteAjaxImageRequest $deleteAjaxImageRequest, Image $image): JsonResponse
    {
        try {
            $image->delete();
            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            logs()->error($e);
            return response(status: 422)->json(['message' => 'Image deleted error']);
        }
    }
}
