<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * To Use This service u must add the following to config/filesystem.php.
 *
 *   'public_uploads' => [
 *           'driver' => 'local',
 *           'root' => public_path('uploads'),
 *    ],
 *
 *  And Install  Intervention\Image\Facades\Image Package
 */
class LocalFileService
{
    public function uploadImage($path, $image, $replaceWith = null)
    {
        if ($replaceWith) {
            $this->deleteFile($replaceWith);
        }

        $path = $this->generatePath('uploads/' . $path);

        Image::make($image)->save(public_path($path . '/' . $image->hashName()));

        return $image->hashName();
    }

    public function deleteFile($path)
    {
        $path = str_replace(asset('uploads'), '', $path);
        Storage::disk('public_uploads')->delete($path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $path folder name in public
     * @param  UploadedFile  $image
     * @return string $name
     */
    public function uploadImageWithResize(string $path, UploadedFile $image, int $width = 300, $height = null)
    {
        $path = $this->generatePath('uploads/' . $path);

        Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($path . '/' . $image->hashName()));

        return $image->hashName();
    }

    public function copyImage($folder, $image)
    {
        $newFileName = rand() . time() . '.png';
        Storage::disk('public_uploads')->copy('/' . $folder . '/' . $image, '/' . $folder . '/' . $newFileName);

        return $newFileName;
    }

    public function uploadBase64Image($path, $image)
    {
        $path = $this->generatePath('uploads/' . $path);
        $name = mt_rand() . time() . '.png';
        Image::make($image)->save(public_path($path . '/' . $name));

        return $name;
    }

    public function uploadFile($path, $requestFile)
    {
        $path = $this->generatePath('uploads/' . $path);
        [$name, $extension] = explode('.', $requestFile->getClientOriginalName());
        $fileName = rand() . '-' . Str::of($name)->slug('-') . '.' . $extension;
        $requestFile->move(public_path($path), $fileName);

        return $fileName;
    }

    public function generatePath($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
}
