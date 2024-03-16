<?php

namespace App\Models\Common;

use Intervention\Image\Laravel\Facades\Image;

class ImageResize
{
    static function resize($filename, $created_at, $w = 300, $h = 300): string
    {

        $imageDir = '/image/'. date("Y", strtotime($created_at));
        $imageThumbDir = '/image/thumb/'. date("Y", strtotime($created_at));

        if (empty($filename)) {
            $filename = 'no-image.jpg';
            $oldFilename = '/image/' . $filename;
        } else {
            $oldFilename = $imageDir . '/' . $filename;
        }

        $newFilename = $imageThumbDir. '/' . $w . 'x' . $h . '-' . $filename;

        if (!file_exists(public_path($newFilename))) {

            $newFilenameParts = explode('/', $newFilename);

            $path = public_path();

            unset($newFilenameParts[count($newFilenameParts) - 1]);

            foreach ($newFilenameParts as $part) {

                $path .= '/' . $part;

                if (!file_exists($path)) {
                    @mkdir($path, 0777);
                }

            }

            $thumb = Image::read(public_path($oldFilename));
            $thumb->cover($w, $h);
            $thumb->save(public_path($newFilename));
        }

        return asset($newFilename);
    }

    static function uploadImage($file, $created_at): string
    {

        $filename = 'no-image.jpg';

        if ($file) {
            $imageDir = '/image/'. date("Y", strtotime($created_at));
            $filename = $file->hashName();
            $file->move(public_path($imageDir), $filename);
        }

        return $filename;
    }

}
