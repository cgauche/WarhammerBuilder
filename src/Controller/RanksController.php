<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\RanksType;
use App\Entity\Ranks;
use App\Entity\Careers;
use App\Entity\Characteristics;

class RanksController extends AbstractController
{

    #[Route('/admin/editCareers/Ranks/{id}', name: 'editRanks')]
    public function editRanks(ManagerRegistry $doctrine, string $id){
        $nameC = $doctrine->getRepository(Careers::class)->find($id)->getName();
        return new Response($this->renderView('Ranks/index.html.twig', [
            'id' => $id,
            'nameC' => $nameC
        ]));
    }

    #[Route('/admin/readCareersRanks', name: 'readCareersRanks', methods : ['POST'])]
    public function readCareersRanks(ManagerRegistry $doctrine, Request $request){
        $Ranks = $doctrine->getRepository(Ranks::class)->findBy(['idCareer' => $request->request->get('id')]);
        $result = [];
        foreach ($Ranks as $r) {
            $tmp = null;
            $nameC = '';
            if($r->getIdCharac() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac());
                if($tmp != null){
                    $nameC = $tmp->getName();
                }
            }
            if($r->getIdCharac2() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac2());
                if($tmp != null){
                    $nameC = ($nameC != '' ? $nameC . ', ' : '') . $tmp->getName();
                }
            }
            if($r->getIdCharac3() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac3());
                if($tmp != null){
                    $nameC = ($nameC != '' ? $nameC . ', ' : '') . $tmp->getName();
                }
            }

            $result[] = [
                'id' => $r->getId(),
                'name' => $r->getName(),
                'status' => $r->getStatus(),
                'charac' => $nameC
            ];
        }
        return new Response($this->renderView('Ranks/tableRanks.html.twig',['ranks' => $result]));
    }

    #[Route('/admin/createRanks', name: 'createRanks', methods : ['POST'])]
    public function createRanks(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Ranks = new Ranks();
            $Ranks->setName($request->request->get('name'));
            $Ranks->setStatus($request->request->get('status'));
            $Ranks->setIdCareer($request->request->get('id'));
            $Ranks->setIdCharac($request->request->get('idCharac'));
            
            $idC2 = $request->request->get('idCharac2');
            $Ranks->setIdCharac2($idC2 == '' ? null : $idC2);
            $idC3 = $request->request->get('idCharac3');
            $Ranks->setIdCharac3($idC3 == '' ? null : $idC3);
            $idSource = $request->request->get('idSource');
            $Ranks->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Ranks);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readRanks', name : 'readRanks', methods : ['POST'])]
    public function readRanks(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Ranks = $doctrine->getRepository(Ranks::class)->find($id);
        }else{
            $Ranks = new Ranks();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(RanksType::class, $Ranks)
        ]);
    }

    #[Route('/admin/updateRanks', name: 'updateRanks', methods : ['POST'])]
    public function updateRanks(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Ranks = $doctrine->getRepository(Ranks::class)->find($request->request->get('id'));
            $Ranks->setName($request->request->get('name'));
            $Ranks->setStatus($request->request->get('status'));
            $Ranks->setIdCharac($request->request->get('idCharac'));
            
            $idC2 = $request->request->get('idCharac2');
            $Ranks->setIdCharac2($idC2 == '' ? null : $idC2);
            $idC3 = $request->request->get('idCharac3');
            $Ranks->setIdCharac3($idC3 == '' ? null : $idC3);
            $idSource = $request->request->get('idSource');
            $Ranks->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Ranks);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteRanks', name: 'deleteRanks', methods : ['POST'])]
    public function deleteRanks(ManagerRegistry $doctrine, Request $request){
        $Ranks = $doctrine->getRepository(Ranks::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Ranks);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
