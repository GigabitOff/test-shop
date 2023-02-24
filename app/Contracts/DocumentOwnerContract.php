<?php

namespace App\Contracts;

/**
 * Interface for Model
 */
interface DocumentOwnerContract
{
    public function getStorageUri(): string;

    public function getUniqueKey(): string;

    public function saveFileInfo(string $fileName, string $path);
}
