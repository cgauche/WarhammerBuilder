<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Source;
use App\Entity\WeaponAttr;
use App\Form\WeaponAttrType;

class WeaponAttrController extends AbstractController
{
    #[Route('/admin/editWAttr', name: 'editWAttr')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('weapon_attr/index.html.twig');
    }
    
    #[Route('/admin/readAllWAttr', name: 'readAllWAttr', methods : ['POST'])]
    public function readAllWAttr(ManagerRegistry $doctrine){
        $WAttrs = $doctrine->getRepository(WeaponAttr::class)->findAll();
        $result = [];
        foreach ($WAttrs as $wa) {
            $source = null;
            if($wa->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($wa->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $wa->getId(),
                'name' => $wa->getName(),
                'withRank' => $wa->getWithRank() == 1 ? 'Oui' : 'Non',
                'desc' => $wa->getDescription(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('weapon_attr/tableWAttr.html.twig',['WAttrs' => $result]));
    }

    #[Route('/admin/createWAttr', name: 'createWAttr', methods : ['POST'])]
    public function createWAttr(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $wa = new WeaponAttr();
            $wa->setName($request->request->get('name'));

            $desc = $request->request->get('desc');
            $wa->setDescription($desc == '' ? null : $desc);
            $withR = $request->request->get('withR');
            $wa->setWithRank($withR == '' ? false : $withR);
            $idSource = $request->request->get('idSource');
            $wa->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($wa);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readWAttr', name : 'readWAttr', methods : ['POST'])]
    public function readWAttr(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $wa = $doctrine->getRepository(WeaponAttr::class)->find($id);
        }else{
            $wa = new WeaponAttr();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(WeaponAttrType::class, $wa)
        ]);
    }

    #[Route('/admin/updateWAttr', name: 'updateWAttr', methods : ['POST'])]
    public function updateWAttr(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $wa = $doctrine->getRepository(WeaponAttr::class)->find($request->request->get('id'));
            $wa->setName($request->request->get('name'));

            $desc = $request->request->get('desc');
            $wa->setDescription($desc == '' ? null : $desc);
            $withR = $request->request->get('withR');
            $wa->setWithRank($withR == '' ? false : $withR);
            $idSource = $request->request->get('idSource');
            $wa->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($wa);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteWAttr', name: 'deleteWAttr', methods : ['POST'])]
    public function deleteWAttr(ManagerRegistry $doctrine, Request $request){
        $wa = $doctrine->getRepository(WeaponAttr::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($wa);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
