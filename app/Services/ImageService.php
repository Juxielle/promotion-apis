<?php

namespace App\Services;

use App\Classes\Constant;
use Exception;


class ImageService
{
    public static function isImageFromBase64Valid($base64Image): bool
    {
        return preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type) ||
               preg_match('/^data:application\/(\w+);base64,/', $base64Image, $type);
    }

    public static function extentionImageFromBase64($base64Image): string|null
    {
        if(!self::isImageFromBase64Valid($base64Image)) return null;
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type) &&
            !preg_match('/^data:application\/(\w+);base64,/', $base64Image, $type)) return null;
        $extension = strtolower($type[1]);
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) return null;
        return $extension;
    }
    
    public static function saveImageFromBase64($base64Image, string $filePath, string $fileName): void
    {
        try{
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type) ||
                preg_match('/^data:application\/(\w+);base64,/', $base64Image, $type)) {
                $image = substr($base64Image, strpos($base64Image, ',') + 1);
                $extension = strtolower($type[1]);

                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
                    throw new Exception(Constant::SAVE_FILE_EXTENSION_ERROR);
                }

                $image = base64_decode($image);
                if ($image === false) {
                    throw new Exception(Constant::SAVE_INVALID_BASE64_FILE);
                }

                //$fileName = $fileName . '.' . $extension;
                $filePath = $filePath ."/". $fileName;

                file_put_contents($filePath, $image);
            }
            else throw new Exception(Constant::SAVE_INVALID_BASE64_FILE);
        }
        catch(Exception $e){
            throw new Exception(Constant::SAVE_FILE_ERROR);
        }
    }
}