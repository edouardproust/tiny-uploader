<?php
/**
 * Created by PhpStorm.
 * User: ciryk
 * Date: 9/12/18
 * Time: 21:28
 */

namespace App\EventListener;

use App\Entity\Upload;
use App\Service\UploadService;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadListener
{
    private $uploader;

    public function __construct(UploadService $uploader)
    {
        $this->uploader = $uploader;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    private function uploadFile($entity)
    {
        if (!$entity instanceof Upload) {
            return;
        }
        $file = $entity->getFile();
        if ($file instanceof UploadedFile) {
            $filename = $this->uploader->upload($file);
            $entity->setFile($filename);
        }
    }
}
