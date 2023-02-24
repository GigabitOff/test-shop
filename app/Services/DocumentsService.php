<?php

namespace App\Services;

use App\Contracts\DocumentOwnerContract;
use App\Models\DocumentAttachment;
use Illuminate\Http\UploadedFile;

class DocumentsService
{

    /**
     * Save decoded Base64 string to file
     *
     * @param DocumentOwnerContract $owner
     * @param string $filename
     * @param string $base64
     * @return void
     */
    public function saveFromBase64(DocumentOwnerContract $owner, string $filename, string $base64)
    {
        try {
            $content = base64_decode($base64);
            $uri = $owner->getStorageUri();
            $dir = $this->getDirToSave($uri);
            $key = $owner->getUniqueKey();
            $savedName = "{$key}_{$filename}";
            file_put_contents("{$dir}/{$savedName}", $content);

            $owner->saveFileInfo($filename, "{$uri}/{$savedName}");
        } catch (\Exception $e) {
        }
    }

    private function getDirToSave($uri): string
    {
        $path = "app/public/$uri";
        $absolute_path = storage_path($path);
        if (!is_dir($absolute_path)) {
            mkdir($absolute_path, 0755, true);
        }

        return $absolute_path;
    }

    /**
     * Сохранение загруженного изображения
     *
     * @param DocumentOwnerContract $owner
     * @param UploadedFile $file
     * @param string $filename
     * @return void
     */
    public function saveUploadedImage(DocumentOwnerContract $owner, UploadedFile $file, string $filename)
    {
        $uri = $owner->getStorageUri();
        $path = $file->storeAs($uri, $filename, 'public');
        $owner->attachments()->create([
            'type' => DocumentAttachment::TYPE_IMAGE,
            'path' => $path,
        ]);
    }
}
