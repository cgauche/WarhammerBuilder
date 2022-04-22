<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $linkToEdit = $this->generateUrl('editSource');
        $linkToAV = $this->generateUrl('editAV');
        $linkToClasses = $this->generateUrl('editClasses');
        $linkToSpecies = $this->generateUrl('editSpecies');
        return $this->render('admin/index.html.twig', [
            'linkToSource' => $linkToEdit,
            'linkToAV' => $linkToAV,
            'linkToClasses' => $linkToClasses,
            'linkToSpecies' => $linkToSpecies
        ]);
    }
}