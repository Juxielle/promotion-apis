<?php

namespace App\Services;

use App\Classes\Constant;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FileSystemService
{
    public static function IsFile(Request $request, string $key): bool
    {
        return $request->hasFile($key) || 
               ImageService::isImageFromBase64Valid($request->input($key));
    }

    public static function buildName(Request $request, string $key, string $baseName): string
    {
        $extension = $request->hasFile($key) ? $request->file($key)->extension() : 
                    ImageService::extentionImageFromBase64($request->input($key));
        
        $name = strtolower($baseName) . strtotime(now() . "") . "." . $extension;
        return $name;
    }

    public static function save(Request $request, string $key, string $fileName, string $path): void
    {
        try{
            if($request->hasFile($key)){
                $file = $request->file($key);
                $file->move(public_path($path), $fileName);
            }
            else if(ImageService::isImageFromBase64Valid($request->input($key))){
                ImageService::saveImageFromBase64($request->input($key), $path, $fileName);
            }
            
            if(!is_file("{$path}/{$fileName}"))
                throw new Exception(Constant::SAVE_FILE_ERROR);
        }
        catch(Exception $e){
            throw new Exception(Constant::SAVE_FILE_ERROR);
        }
    }

    public static function delete(string $fillPath): void
    {
        try{
            if(!is_file($fillPath))
                throw new Exception(Constant::DELETE_FILE_ERROR);
            unlink($fillPath);
        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}