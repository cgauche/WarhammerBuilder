<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CharacteristicsType;
use App\Entity\Characteristics;

class CharacteristicsController extends AbstractController
{
    #[Route('/admin/editCharac', name: 'editCharac')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('characteristics/index.html.twig');
    }
    
    #[Route('/admin/readAllCharacs', name: 'readAllCharacs', methods : ['POST'])]
    public function readAllCharacs(ManagerRegistry $doctrine){
        $Characs = $doctrine->getRepository(Characteristics::class)->findAll();
        
        return new Response($this->renderView('characteristics/tableCharac.html.twig',['Characs' => $Characs]));
    }

    #[Route('/admin/createCharac', name: 'createCharac', methods : ['POST'])]
    public function createCharac(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Charac = new Characteristics();
            $Charac->setName($request->request->get('name'));
            $Charac->setAbridged($request->request->get('abridged'));
            
            $description = $request->request->get('desc');
            $Charac->setDescription($description == '' ? null : $description);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Charac);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readCharac', name : 'readCharac', methods : ['POST'])]
    public function readCharac(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Charac = $doctrine->getRepository(Characteristics::class)->find($id);
        }else{
            $Charac = new Characteristics();
        }

        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(CharacteristicsType::class, $Charac)
        ]);
    }

    #[Route('/admin/updateCharac', name: 'updateCharac', methods : ['POST'])]
    public function updateCharac(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Charac = $doctrine->getRepository(Characteristics::class)->find($request->request->get('id'));
            $Charac->setName($request->request->get('name'));
            $Charac->setAbridged($request->request->get('abridged'));
            
            $description = $request->request->get('desc');
            $Charac->setDescription($description == '' ? null : $description);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Charac);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteCharac', name: 'deleteCharac', methods : ['POST'])]
    public function deleteCharac(ManagerRegistry $doctrine, Request $request){
        $Charac = $doctrine->getRepository(Characteristics::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Charac);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
