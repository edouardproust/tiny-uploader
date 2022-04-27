<?php
/**
 * Created by PhpStorm.
 * User: ciryk
 * Date: 9/12/18
 * Time: 21:27
 */

namespace App\Form;

use App\Entity\Upload;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadType extends FileType
{
    private $uploadsDirectory;

    public function __construct($uploadsDirectory)
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->addModelTransformer(new CallbackTransformer(
            function (Upload $upload = null) {
                if ($upload instanceof Upload && $upload->getId()) {
                    return new File($this->uploadsDirectory . $upload->getFile());
                }
            },
            function (UploadedFile $uploadedFile = null) {
                if ($uploadedFile instanceof UploadedFile) {
                    $upload = new Upload();
                    $upload->setFile($uploadedFile);
                    return $upload;
                }
            }
        ));
    }

    public function getBlockPrefix()
    {
        return 'upload';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'required' => false
        ]);
    }
}
