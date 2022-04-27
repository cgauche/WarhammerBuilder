<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\BagsContainersType;
use App\Entity\BagsContainers;
use App\Entity\Source;

class BagsContainersController extends AbstractController
{
    #[Route('/admin/editBC', name: 'editBC')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('bags_containers/index.html.twig');
    }
    
    #[Route('/admin/readAllBC', name: 'readAllBC', methods : ['POST'])]
    public function readAllAV(ManagerRegistry $doctrine){
        $BCs = $doctrine->getRepository(BagsContainers::class)->findAll();
        $result = [];
        foreach ($BCs as $BC) {
            $source = null;
            if($BC->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($BC->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $BC->getId(),
                'name' => $BC->getName(),
                'clutter' => $BC->getClutter(),
                'price' => $BC->getPrice(),
                'contents' => $BC->getContents(),
                'availability' => $BC->getAvailability(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('bags_containers/tableBC.html.twig',['containers' => $result]));
    }

    #[Route('/admin/createBC', name: 'createBC', methods : ['POST'])]
    public function createAV(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $BC = new BagsContainers();
            $BC->setName($request->request->get('name'));
            $BC->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $BC->setPrice($price == '' ? null : $price);
            $contents = $request->request->get('contents');
            $BC->setContents($contents == '' ? null : $contents);
            $availability = $request->request->get('availability');
            $BC->setAvailability($availability == '' ? null : $ailability);
            $idSource = $request->request->get('idSource');
            $BC->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($BC);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readBC', name : 'readBC', methods : ['POST'])]
    public function readAV(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $BC = $doctrine->getRepository(BagsContainers::class)->find($id);
        }else{
            $BC = new BagsContainers();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(BagsContainersType::class, $BC)
        ]);
    }

    #[Route('/admin/updateBC', name: 'updateBC', methods : ['POST'])]
    public function updateAV(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $BC = $doctrine->getRepository(BagsContainers::class)->find($request->request->get('id'));
            $BC->setName($request->request->get('name'));
            $BC->setClutter($request->request->get('clutter'));

            $price = $request->request->get('price');
            $BC->setPrice($price == '' ? null : $price);
            $contents = $request->request->get('contents');
            $BC->setContents($contents == '' ? null : $contents);
            $availability = $request->request->get('availability');
            $BC->setAvailability($availability == '' ? null : $availability);
            $idSource = $request->request->get('idSource');
            $BC->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($BC);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteBC', name: 'deleteBC', methods : ['POST'])]
    public function deleteAV(ManagerRegistry $doctrine, Request $request){
        $BC = $doctrine->getRepository(BagsContainers::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($BC);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
