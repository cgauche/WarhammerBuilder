<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AnimalsVehiclesType;
use App\Entity\AnimalsVehicles;
use App\Entity\Source;

class AnimalsVehiclesController extends AbstractController
{
    #[Route('/admin/editAV', name: 'editAV')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('animals_vehicles/index.html.twig');
    }
    
    #[Route('/admin/readAllAV', name: 'readAllAV', methods : ['POST'])]
    public function readAllAV(ManagerRegistry $doctrine){
        $AVs = $doctrine->getRepository(AnimalsVehicles::class)->findAll();
        $result = [];
        foreach ($AVs as $av) {
            $source = null;
            if($av->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($av->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $av->getId(),
                'name' => $av->getName(),
                'clutter' => $av->getClutter(),
                'price' => $av->getPrice(),
                'contents' => $av->getContents(),
                'availability' => $av->getAvailability(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('animals_vehicles/tableAV.html.twig',['vehicles' => $result]));
    }

    #[Route('/admin/createAV', name: 'createAV', methods : ['POST'])]
    public function createAV(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $AV = new AnimalsVehicles();
            $AV->setName($request->request->get('name'));
            $AV->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $AV->setPrice($price == '' ? null : $price);
            $contents = $request->request->get('contents');
            $AV->setContents($contents == '' ? null : $contents);
            $availability = $request->request->get('availability');
            $AV->setAvailability($availability == '' ? null : $availability);
            $idSource = $request->request->get('idSource');
            $AV->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($AV);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readAV', name : 'readAV', methods : ['POST'])]
    public function readAV(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $AV = $doctrine->getRepository(AnimalsVehicles::class)->find($id);
        }else{
            $AV = new AnimalsVehicles();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(AnimalsVehiclesType::class, $AV)
        ]);
    }

    #[Route('/admin/updateAV', name: 'updateAV', methods : ['POST'])]
    public function updateAV(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $AV = $doctrine->getRepository(AnimalsVehicles::class)->find($request->request->get('id'));
            $AV->setName($request->request->get('name'));
            $AV->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $AV->setPrice($price == '' ? null : $price);
            $contents = $request->request->get('contents');
            $AV->setContents($contents == '' ? null : $contents);
            $availability = $request->request->get('availability');
            $AV->setAvailability($availability == '' ? null : $availability);
            $idSource = $request->request->get('idSource');
            $AV->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($AV);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteAV', name: 'deleteAV', methods : ['POST'])]
    public function deleteAV(ManagerRegistry $doctrine, Request $request){
        $AV = $doctrine->getRepository(AnimalsVehicles::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($AV);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
