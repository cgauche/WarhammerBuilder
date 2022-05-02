<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TalentsType;
use App\Entity\Talents;
use App\Entity\Source;

class TalentsController extends AbstractController
{
    #[Route('/admin/editTalents', name: 'editTalents')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('Talents/index.html.twig');
    }
    
    #[Route('/admin/readAllTalents', name: 'readAllTalents', methods : ['POST'])]
    public function readAllTalents(ManagerRegistry $doctrine){
        $Talents = $doctrine->getRepository(Talents::class)->findAll();
        $result = [];
        foreach ($Talents as $t) {
            $source = null;
            if($t->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($t->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $t->getId(),
                'name' => $t->getName(),
                'max' => $t->getMax(),
                'test' => $t->getTest(),
                'aleat' => ($t->getMinRoll() != '' ? $t->getMinRoll() . " - " . $t->getMaxRoll() : '' ),
                'source' => $source 
            ];
        }
        
        return new Response($this->renderView('Talents/tableTalents.html.twig',['Talents' => $result]));
    }

    #[Route('/admin/createTalents', name: 'createTalents', methods : ['POST'])]
    public function createTalents(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Talents = new Talents();
            $Talents->setName($request->request->get('name'));
            $Talents->setMax($request->request->get('max'));
            
            $minRoll = $request->request->get('minRoll');
            $Talents->setMinRoll($minRoll == '' ? null : $minRoll);
            $maxRoll = $request->request->get('maxRoll');
            $Talents->setMaxRoll($maxRoll == '' ? null : $maxRoll);
            $test = $request->request->get('test');
            $Talents->setTest($test == '' ? null : $test);
            $desc = $request->request->get('description');
            $Talents->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Talents->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Talents);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readTalents', name : 'readTalents', methods : ['POST'])]
    public function readTalents(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Talents = $doctrine->getRepository(Talents::class)->find($id);
        }else{
            $Talents = new Talents();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(TalentsType::class, $Talents)
        ]);
    }

    #[Route('/admin/updateTalents', name: 'updateTalents', methods : ['POST'])]
    public function updateTalents(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Talents = $doctrine->getRepository(Talents::class)->find($request->request->get('id'));
            $Talents->setName($request->request->get('name'));
            $Talents->setMax($request->request->get('max'));
            
            $minRoll = $request->request->get('minRoll');
            $Talents->setMinRoll($minRoll == '' ? null : $minRoll);
            $maxRoll = $request->request->get('maxRoll');
            $Talents->setMaxRoll($maxRoll == '' ? null : $maxRoll);
            $test = $request->request->get('test');
            $Talents->setTest($test == '' ? null : $test);
            $desc = $request->request->get('description');
            $Talents->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Talents->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Talents);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteTalents', name: 'deleteTalents', methods : ['POST'])]
    public function deleteTalents(ManagerRegistry $doctrine, Request $request){
        $Talents = $doctrine->getRepository(Talents::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Talents);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
