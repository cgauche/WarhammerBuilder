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
        $linkToCharac = $this->generateUrl('editCharac');
        $linkToAV = $this->generateUrl('editAV');
        $linkToBC = $this->generateUrl('editBC');
        $linkToClasses = $this->generateUrl('editClasses');
        $linkToSpecies = $this->generateUrl('editSpecies');
        $linkToCareers = $this->generateUrl('editCareers');
        $linkToWAttr = $this->generateUrl('editWAttr');
        $linkToArmoury = $this->generateUrl('editArmoury');
        $linkToSpells = $this->generateUrl('editSpells');
        $linkToSpellFamily = $this->generateUrl('editSpellFamily');
        return $this->render('admin/index.html.twig', [
            'linkToSource' => $linkToEdit,
            'linkToCharac' => $linkToCharac,
            'linkToAV' => $linkToAV,
            'linkToBC' => $linkToBC,
            'linkToClasses' => $linkToClasses,
            'linkToSpecies' => $linkToSpecies,
            'linkToCareers' => $linkToCareers,
            'linkToWAttr' => $linkToWAttr,
            'linkToArmoury' => $linkToArmoury,
            'linkToSpells' => $linkToSpells,
            'linkToSpellFamily' => $linkToSpellFamily
        ]);
    }
}
