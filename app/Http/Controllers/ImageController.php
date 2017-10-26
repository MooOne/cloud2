<?php namespace Yeelight\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Yeelight\Http\Controllers\BaseController;
use Yeelight\Services\Image\Controllers\YeelightImageController;
use Yeelight\Models\Image\YeelightImage;
use Yeelight\Services\Image\YeelightImageService;

class ImageController extends BaseController
{

    public function postImage(Request $request)
    {
        $yeelightImageService = new YeelightImageService();
        $file = $request->file('image');

        $yeelightImage = null;
        try {
            /** @var YeelightImage $yeelightImage */
            $yeelightImage = $yeelightImageService->handleUploadedFile($file);
        } catch (Exception $e) {
            return response('Failed to save: ' . $e->getMessage(), 422);
        }

        if (!$yeelightImage) {
            return response('Failed to save uploaded image.', 422);
        }

        $yeelightImageId = $yeelightImage->getYeelightImageId();
        return response([
            'data' => [
                'yeelight_image_id' => $yeelightImage->getYeelightImageId(),
                'yeelight_image_url' => $yeelightImage->getImageUrl(),
                'thumbnail_image_url' => $yeelightImage->getTypeImageUrl('thumbnail'),
            ]
        ]);
    }

    public function showOriginalImage($image_name)
    {
        return YeelightImageController::showImage('original', $image_name);
    }

    public function showTypeImage($type, $image_name)
    {
        return YeelightImageController::showImage($type, $image_name);
    }

}