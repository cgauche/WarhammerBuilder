<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    #[Route('/admin/home', name: 'homeAdmin')]
    public function homeAdmin(): Response
    {
        $linkToSource = $this->generateUrl('editSource');
        $linkToUser = $this->generateUrl('editUser');
        $linkToCharac = $this->generateUrl('editCharac');
        $linkToAV = $this->generateUrl('editAV');
        $linkToBC = $this->generateUrl('editBC');
        $linkToClasses = $this->generateUrl('editClasses');
        $linkToTalents = $this->generateUrl('editTalents');
        $linkToSkills = $this->generateUrl('editSkills');
        $linkToSpecies = $this->generateUrl('editSpecies');
        $linkToCareers = $this->generateUrl('editCareers');
        $linkToWAttr = $this->generateUrl('editWAttr');
        $linkToArmoury = $this->generateUrl('editArmoury');
        $linkToSpells = $this->generateUrl('editSpells');
        $linkToSpellFamily = $this->generateUrl('editSpellFamily');
        $linkToItems = $this->generateUrl('editTrapping');
        return $this->render('admin/index.html.twig', [
            'linkToSource' => $linkToSource,
            'linkToUser' => $linkToUser,
            'linkToCharac' => $linkToCharac,
            'linkToAV' => $linkToAV,
            'linkToBC' => $linkToBC,
            'linkToClasses' => $linkToClasses,
            'linkToSpecies' => $linkToSpecies,
            'linkToCareers' => $linkToCareers,
            'linkToWAttr' => $linkToWAttr,
            'linkToArmoury' => $linkToArmoury,
            'linkToSpells' => $linkToSpells,
            'linkToSpellFamily' => $linkToSpellFamily,
            'linkToTalents' => $linkToTalents,
            'linkToItems' => $linkToItems,
            'linkToSkills' => $linkToSkills
        ]);
    }
    
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('admin/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function logout(){

    }
}
