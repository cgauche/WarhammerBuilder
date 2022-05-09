<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TrappingType;
use App\Entity\Trapping;
use App\Entity\Source;

class TrappingController extends AbstractController
{
    #[Route('/admin/editTrapping', name: 'editTrapping')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('trapping/index.html.twig');
    }
    
    #[Route('/admin/readAllTrapping', name: 'readAllTrapping', methods : ['POST'])]
    public function readAllAV(ManagerRegistry $doctrine){
        $Trappings = $doctrine->getRepository(Trapping::class)->findAll();
        $result = [];
        foreach ($Trappings as $Trapping) {
            $source = null;
            if($Trapping->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($Trapping->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $Trapping->getId(),
                'name' => $Trapping->getName(),
                'type' => $Trapping->getType(),
                'clutter' => $Trapping->getClutter(),
                'price' => $Trapping->getPrice(),
                'availability' => $Trapping->getAvailability(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('trapping/tableTrapping.html.twig',['containers' => $result]));
    }

    #[Route('/admin/createTrapping', name: 'createTrapping', methods : ['POST'])]
    public function createAV(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Trapping = new Trapping();
            $Trapping->setName($request->request->get('name'));
            $Trapping->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $Trapping->setPrice($price == '' ? null : $price);
            $type = $request->request->get('type');
            $Trapping->setType($type == '' ? null : $type);
            $availability = $request->request->get('availability');
            $Trapping->setAvailability($availability == '' ? null : $ailability);
            $idSource = $request->request->get('idSource');
            $Trapping->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Trapping);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readTrapping', name : 'readTrapping', methods : ['POST'])]
    public function readAV(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Trapping = $doctrine->getRepository(Trapping::class)->find($id);
        }else{
            $Trapping = new Trapping();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(TrappingType::class, $Trapping)
        ]);
    }

    #[Route('/admin/updateTrapping', name: 'updateTrapping', methods : ['POST'])]
    public function updateAV(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Trapping = $doctrine->getRepository(Trapping::class)->find($request->request->get('id'));
            $Trapping->setName($request->request->get('name'));
            $Trapping->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $Trapping->setPrice($price == '' ? null : $price);
            $type = $request->request->get('type');
            $Trapping->setType($type == '' ? null : $type);
            $availability = $request->request->get('availability');
            $Trapping->setAvailability($availability == '' ? null : $availability);
            $idSource = $request->request->get('idSource');
            $Trapping->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Trapping);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteTrapping', name: 'deleteTrapping', methods : ['POST'])]
    public function deleteAV(ManagerRegistry $doctrine, Request $request){
        $Trapping = $doctrine->getRepository(Trapping::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Trapping);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}