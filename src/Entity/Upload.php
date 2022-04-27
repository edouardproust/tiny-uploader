<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UploadRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UploadRepository::class)
 */
class Upload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function getFile():?string
    {
        return $this->file;
    }
    
    public function setFile(?string $file): void
    {
        if ($file) {
            $this->file = $file;
        }
    }
}
