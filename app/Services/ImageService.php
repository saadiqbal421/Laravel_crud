<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload(UploadedFile $file)
    {
        $filename = $file->getClientOriginalName();
        Storage::disk('public')->putFileAs('user_images', $file, $filename);
        return $filename;
    }

    public function resize($file, $width, $height)
    {
        // Logic to resize the image
    }

    // Add more image-related methods as needed
}