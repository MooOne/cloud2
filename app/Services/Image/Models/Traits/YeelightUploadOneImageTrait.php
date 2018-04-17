<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-11
 * Time: 下午1:12
 */
namespace Yeelight\Services\Image\Models\Traits;

use Exception;
use Illuminate\Support\MessageBag;
use Yeelight\Models\Image\YeelightImage;
use Yeelight\Services\Image\Exception\YeelightImageException;
use Yeelight\Services\Image\YeelightImageService;


trait YeelightUploadOneImageTrait
{
    /**
     * 上传单个图片文件
     * @param string $inputName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadOne($inputName = 'image')
    {
        //Upload Image
        $yeelightImageService = new YeelightImageService();
        $file = request()->file($inputName);

        $yeelightImage = null;
        try {
            /** @var YeelightImage $yeelightImage */
            $yeelightImage = $yeelightImageService->handleUploadedFile($file);
        } catch (Exception $e) {
            throw new YeelightImageException('Failed to save: ' . $e->getMessage());
        }

        if (!$yeelightImage) {
            throw new YeelightImageException('Failed to save: ' . 'Failed to save uploaded image.');
        }

        return $yeelightImage;
    }
}
