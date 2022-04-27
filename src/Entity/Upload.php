<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="upload")
 */
class Upload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $file
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload an upload first.")
     */
    private $file;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $alt;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile($file)
    {
        if ($file) {
            $this->file = $file;
        }
    }

    public function getAlt()
    {
        return $this->alt;
    }
    
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }
}
