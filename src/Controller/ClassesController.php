<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ClassesType;
use App\Entity\Classes;
use App\Entity\Source;

class ClassesController extends AbstractController
{
    #[Route('/admin/editClasses', name: 'editClasses')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('classes/index.html.twig');
    }
    
    #[Route('/admin/readAllClasses', name: 'readAllClasses', methods : ['POST'])]
    public function readAllClasses(ManagerRegistry $doctrine){
        $Classes = $doctrine->getRepository(Classes::class)->findAll();
        $result = [];
        foreach ($Classes as $c) {
            $source = null;
            if($c->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($c->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $c->getId(),
                'name' => $c->getName(),
                'desc' => $c->getDescription(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('classes/tableClasses.html.twig',['classes' => $result]));
    }

    #[Route('/admin/createClasses', name: 'createClasses', methods : ['POST'])]
    public function createClasses(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $classe = new Classes();
            $classe->setName($request->request->get('name'));

            $desc = $request->request->get('desc');
            $classe->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $classe->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readClasses', name : 'readClasses', methods : ['POST'])]
    public function readClasses(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Classe = $doctrine->getRepository(Classes::class)->find($id);
        }else{
            $Classe = new Classes();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(ClassesType::class, $Classe)
        ]);
    }

    #[Route('/admin/updateClasses', name: 'updateClasses', methods : ['POST'])]
    public function updateClasses(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $classe = $doctrine->getRepository(Classes::class)->find($request->request->get('id'));
            $classe->setName($request->request->get('name'));

            $desc = $request->request->get('desc');
            $classe->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $classe->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteClasses', name: 'deleteClasses', methods : ['POST'])]
    public function deleteClasses(ManagerRegistry $doctrine, Request $request){
        $classe = $doctrine->getRepository(Classes::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($classe);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
