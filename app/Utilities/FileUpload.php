<?php

namespace App\Utilities;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class FileUpload
{
    public function uploadFile($image, $folder)
    {
        $uploadFile = Cloudinary::upload(($image)->getRealPath(), [
            'folder' => $folder
        ])->getSecurePath();

        return $uploadFile;
    }
}