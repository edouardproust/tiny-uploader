<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\UploadType;
use App\Repository\UploadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FileController extends AbstractController
{
    private $entityManager;
    private $uploadRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UploadRepository $uploadRepository
    ) {
        $this->entityManager = $entityManager;
        $this->uploadRepository = $uploadRepository;
    }

    /**
     * @Route("/", name="file_index")
     */
    public function index(Request $request): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid() && $form->getData() !== null) {
                $this->entityManager->persist($form->getData());
                $this->entityManager->flush();
                $this->addFlash('success', 'The file has been uploaded.');
            } else {
                $this->addFlash('danger', 'Please choose a file.');
            }
        }
        
        return $this->render('file/index.html.twig', [
            'form' => $form->createView(),
            'files' => $this->uploadRepository->findAll()
        ]);
    }
}
