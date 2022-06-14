<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Helper;
use Image;

class UploadFile{
    public static function uploadFile(
        $requestFile,
        $pathDirectory,
        $name,
        $callback = null
    ){
        $file = $requestFile;
        if(!$file){
            return "File Not Found";
        }
        if(!$pathDirectory || $pathDirectory===""){
            return "Please set directory please!";
        }
        if(!$name || $name===""){
            return "Please set name of file!";
        }

        try {
            $new_name = $name.".".$requestFile->getClientOriginalExtension();    
            Helper::initPath($pathDirectory);

            Storage::disk('public')->putFileAs($pathDirectory, $file, $new_name);
            if ($callback) {
                $callback($new_name);
            }
        } catch (\Throwable $th) {
            return $th;
        }
        return "All Process success";
    }

    public static function uploadImage(
        $requestImage,
        $pathDirectory,
        $imageName,
        $dimension = [
            'main' => [
                'width' => 1024,
                'height' => 1024
            ],
            'thumb' => [
                'width' => 250,
                'height' => 250
            ]
        ],
        $callback=null){
        
            $file = $requestImage;
            if(!$file){
                return "File Not Found";
            }
            if(!$pathDirectory || $pathDirectory===""){
                return "Please set directory please!";
            }
            if(!$imageName || $imageName===""){
                return "Please set name of image!";
            }
            $new_name = $imageName.".".$file->extension() ?? $file->getClientOriginalExtension();
            
            try {
                $image = Image::make($file);
            } catch (\Throwable $th) {
                return "Get original failed/ not found" ;
            }

            Helper::initPath($pathDirectory);

			// $max_width = 1024;
			// $max_height = 1024;
            // $max_thumb_w = 250;
            // $max_thumb_h = 250;
            $max_width = isset($dimension['main']['width'])? $dimension['main']['width'] : 1024;
			$max_height = isset($dimension['main']['height'])? $dimension['main']['height'] : 1024;
            $max_thumb_w = isset($dimension['thumb']['width'])? $dimension['thumb']['width'] : 250;
            $max_thumb_h = isset($dimension['thumb']['height'])? $dimension['thumb']['height'] : 250;
            $image->height() > $image->width() ? $max_width = null : $max_height = null;
            
			$image = $image->resize($max_width, $max_height, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})->encode('jpg', 80);
            Storage::disk('public')->put($pathDirectory.$new_name, $image);
            
            $image = $image->fit($max_thumb_w , $max_thumb_h )->encode('jpg', 80);
            Storage::disk('public')->put($pathDirectory.'thumb_'.$new_name, $image);

            if ($callback) {
                $callback($new_name);
            }
            /** End of deleting temporary file */
            return "All Process success";

    }
}