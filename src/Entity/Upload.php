<?php

namespace App\Entity;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }
}


// <?php

// namespace App\Entity;


// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints as Assert;

// /**
//  * @ORM\Entity
//  * @ORM\Table(name="image")
//  */
// class Image
// {
//     /**
//      * @ORM\Id
//      * @ORM\GeneratedValue(strategy="AUTO")
//      * @ORM\Column(type="integer")
//      */
//     private $id;

//     /**
//      * @var string $file
//      * @ORM\Column(type="string")
//      *
//      * @Assert\NotBlank(message="Please, upload an image first.")
//      * @Assert\File(mimeTypes={ "image/png", "image/jpeg", "image/jpg" })
//      */
//     private $file;
//
//     /**
//      * @return mixed
//      */
//     public function getId()
//     {
//         return $this->id;
//     }

//     /**
//      * @param mixed $id
//      */
//     public function setId($id): void
//     {
//         $this->id = $id;
//     }

//     /**
//      * @return string
//      */
//     public function getFile()
//     {
//         return $this->file;
//     }

//     /**
//      * @param string $file
//      */
//     public function setFile($file)
//     {
//         if ($file) {
//             $this->file = $file;
//         }
//     }
// }
