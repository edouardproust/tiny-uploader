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
    /**
     * @Route("/", name="file_index")
     */
    public function index(): Response
    {
        return $this->render('file/index.html.twig');
    }

    /**
     * @Route("/new", name="file_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            return $this->redirectToRoute('file_index');
        }

        return $this->render('file/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
