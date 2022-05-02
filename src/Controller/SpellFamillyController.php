<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SpellFamilyType;
use App\Entity\SpellFamily;
use App\Entity\Source;

class SpellFamillyController extends AbstractController
{
    #[Route('/admin/editSpellFamily', name: 'editSpellFamily')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('spell_family/index.html.twig');
    }
    
    #[Route('/admin/readAllSpellFamily', name: 'readAllSpellFamily', methods : ['POST'])]
    public function readAllSpellFamily(ManagerRegistry $doctrine){
        $SpellFamily = $doctrine->getRepository(SpellFamily::class)->findAll();
        $result = [];
        foreach ($SpellFamily as $st) {
            $source = null;
            if($st->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($st->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $st->getId(),
                'name' => $st->getName(),
                'type' => $st->getType(),
                'color' => $st->getColor(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('spell_family/tableSpellFamily.html.twig',['SpellFamily' => $result]));
    }

    #[Route('/admin/createSpellFamily', name: 'createSpellFamily', methods : ['POST'])]
    public function createSpellFamily(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $SpellFamily = new SpellFamily();
            $SpellFamily->setName($request->request->get('name'));
            $SpellFamily->setType($request->request->get('type'));

            $realName = $request->request->get('realname');
            $SpellFamily->setRealName($realName == '' ? null : $realName);
            $color = $request->request->get('color');
            $SpellFamily->setColor($color == '' ? null : $color);
            $desc = $request->request->get('desc');
            $SpellFamily->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $SpellFamily->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($SpellFamily);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readSpellFamily', name : 'readSpellFamily', methods : ['POST'])]
    public function readSpellFamily(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $SpellFamily = $doctrine->getRepository(SpellFamily::class)->find($id);
        }else{
            $SpellFamily = new SpellFamily();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(SpellFamilyType::class, $SpellFamily)
        ]);
    }

    #[Route('/admin/updateSpellFamily', name: 'updateSpellFamily', methods : ['POST'])]
    public function updateSpellFamily(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $SpellFamily = $doctrine->getRepository(SpellFamily::class)->find($request->request->get('id'));
            $SpellFamily->setName($request->request->get('name'));
            $SpellFamily->setType($request->request->get('type'));

            $realName = $request->request->get('realname');
            $SpellFamily->setRealName($realName == '' ? null : $realName);
            $color = $request->request->get('color');
            $SpellFamily->setColor($color == '' ? null : $color);
            $desc = $request->request->get('desc');
            $SpellFamily->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $SpellFamily->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($SpellFamily);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteSpellFamily', name: 'deleteSpellFamily', methods : ['POST'])]
    public function deleteSpellFamily(ManagerRegistry $doctrine, Request $request){
        $SpellFamily = $doctrine->getRepository(SpellFamily::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($SpellFamily);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
