<?php

namespace App\Services;

use App\Contracts\ImagesOwnerContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImagesService
{

    /**
     * Загружка изображений с проверкой по LastModified
     * Позволяет выловить изменения даже если url не изменился
     *
     * @param ImagesOwnerContract $owner
     * @param array $urls
     * @param bool $isMain
     * @return void
     */
    public function uploadImages(ImagesOwnerContract $owner, array $urls, bool $isMain = false)
    {
        $images = $owner->images->where('main', $isMain);
        $uri = $owner->getStorageUri();
        foreach ($urls as $url) {
            $lastModified = '';
            if ($saved = $images->where('import_url', $url)->first()) {
                $lastModified = $saved->last_modified ?? '';
            }

            if ($lastModified) {
                if ('none' === $lastModified){
                    continue;
                }
                $uploaded = Http::withHeaders(['If-Modified-Since' => $lastModified])->get($url);
            } else {
                $uploaded = Http::get($url);
            }

            if (200 != $uploaded->status()){
                continue;
            }

            $fileInfo = $this->getFileInfo($url);
            $newFileName = Str::uuid() . '.' . $fileInfo['extension'];
            $filePath = "{$uri}/{$newFileName}";

            Storage::disk('public')->put($filePath, $uploaded->body() );

            $owner->images()->updateOrCreate(
                [
                    'id' => $saved->id ?? 0,
                ],
                [
                'import_url' => $url,
                'url' => $filePath,
                'last_modified' => $uploaded->header('Last-Modified') ?: 'none',
                'main' => $isMain,
            ]);
        }


        // очистка старых image
        foreach ($images as $image) {
            if (!in_array($image->import_url, $urls)) {
                $this->deleteImage($image->url);
                $image->delete();
            }
        }
    }

    private function getFileInfo(string $url)
    {
        return pathinfo(parse_url($url, PHP_URL_PATH));
    }

    private function deleteImage($path)
    {
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
