<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\UploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="file_index")
     */
    public function index(): Response
    {
        return $this->render('file/index.html.twig', [
            'files' => ['file1', 'file2'] //$this->entityManager->findAll()
        ]);
    }

    /**
     * @Route("/new", name="file_new")
     */
    public function new(Request $request): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();
            return $this->redirectToRoute('file_index');
        }
        
        return $this->render('file/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
