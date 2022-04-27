<?php
/**
 * Created by PhpStorm.
 * User: ciryk
 * Date: 11/07/18
 * Time: 19:23
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    private $uploadsDirectory;
    private $slugger;

    public function __construct(
        $uploadsDirectory,
        SluggerInterface $slugger
    ) {
        $this->uploadsDirectory = $uploadsDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        // add a uniq id before extension
        $parts = explode('.', $file->getClientOriginalName());
        $fileName = substr($this->slugger->slug(strtolower($parts[0])), 0, 30);
        $secureName = $fileName . '.' . uniqid() . '.' . $file->guessExtension();
        // save file
        $file->move($this->uploadsDirectory, $secureName);
        return $secureName;
    }
}
