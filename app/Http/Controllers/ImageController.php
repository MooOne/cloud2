<?php

namespace Yeelight\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Yeelight\Services\Image\Controllers\YeelightImageController;
use Yeelight\Services\Image\YeelightImageService;

/**
 * Class ImageController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ImageController extends BaseController
{
    /**
     * PostImage
     *
     * @param Request $request Request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function postImage(Request $request)
    {
        $yeelightImageService = new YeelightImageService();
        $file = $request->file('image');

        $yeelightImage = null;

        try {
            // @var YeelightImage $yeelightImage
            $yeelightImage = $yeelightImageService->handleUploadedFile($file);
        } catch (Exception $e) {
            return response('Failed to save: '.$e->getMessage(), 422);
        }

        if (!$yeelightImage) {
            return response('Failed to save uploaded image.', 422);
        }

        //$yeelightImageId = $yeelightImage->getYeelightImageId();

        return response([
            'data' => [
                'yeelight_image_id'   => $yeelightImage->getYeelightImageId(),
                'yeelight_image_url'  => $yeelightImage->getImageUrl(),
                'thumbnail_image_url' => $yeelightImage->getTypeImageUrl('thumbnail'),
            ],
        ]);
    }

    /**
     * ShowOriginalImage
     *
     * @param string $imageName imageName
     *
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showOriginalImage($imageName)
    {
        return YeelightImageController::showImage('original', $imageName);
    }

    /**
     * ShowTypeImage
     *
     * @param string $type type
     * @param string $imageName imageName
     *
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showTypeImage($type, $imageName)
    {
        return YeelightImageController::showImage($type, $imageName);
    }
}
