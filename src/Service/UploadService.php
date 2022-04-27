<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $filename = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->targetDirectory, $filename);
        return $filename;
    }
}
