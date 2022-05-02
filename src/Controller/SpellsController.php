<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SpellsType;
use App\Entity\SpellFamily;
use App\Entity\Spells;
use App\Entity\Source;


class SpellsController extends AbstractController
{
    #[Route('/admin/editSpells', name: 'editSpells')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('spells/index.html.twig');
    }
    
    #[Route('/admin/readAllSpells', name: 'readAllSpells', methods : ['POST'])]
    public function readAllSpells(ManagerRegistry $doctrine){
        $Spells = $doctrine->getRepository(Spells::class)->findAll();
        $result = [];
        foreach ($Spells as $s) {
            $source = null;
            if($s->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($s->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }
            $type = $s->getType();
            if($s->getIdSource() != null){
                $sf = $doctrine->getRepository(SpellFamily::class)->find($s->getIdSpellFamily());
                if($sf != null){
                    $type = $sf->getName() . ($type != '' ? ' ('. $type .')' : '');
                }
            }

            $result[] = [
                'id' => $s->getId(),
                'name' => $s->getName(),
                'type' => $type,
                'ni' => $s->getNi(),
                'range' => $s->getRange(),
                'target' => $s->getTarget(),
                'damage' => $s->getDamage(),
                'length' => $s->getLength(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('spells/tableSpells.html.twig',['Spells' => $result]));
    }

    #[Route('/admin/createSpells', name: 'createSpells', methods : ['POST'])]
    public function createSpells(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Spells = new Spells();
            $Spells->setName($request->request->get('name'));
            $Spells->setNi($request->request->get('ni'));
            $Spells->setIdSpellFamily($request->request->get('idSpellFamily'));
            
            $type = $request->request->get('type');
            $Spells->setType($type = '' ? null : $type);
            $range = $request->request->get('range');
            $Spells->setRange($range = '' ? null : $range);
            $target = $request->request->get('target');
            $Spells->setTarget($target = '' ? null : $target);
            $length = $request->request->get('length');
            $Spells->setLength($length = '' ? null : $length);
            $damage = $request->request->get('damage');
            $Spells->setDamage($damage = '' ? null : $damage);
            $desc = $request->request->get('desc');
            $Spells->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Spells->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Spells);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readSpells', name : 'readSpells', methods : ['POST'])]
    public function readSpells(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Spells = $doctrine->getRepository(Spells::class)->find($id);
        }else{
            $Spells = new Spells();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(SpellsType::class, $Spells)
        ]);
    }

    #[Route('/admin/updateSpells', name: 'updateSpells', methods : ['POST'])]
    public function updateSpells(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Spells = $doctrine->getRepository(Spells::class)->find($request->request->get('id'));
            $Spells->setName($request->request->get('name'));
            $Spells->setNi($request->request->get('ni'));
            $Spells->setIdSpellFamily($request->request->get('idSpellFamily'));
            
            $type = $request->request->get('type');
            $Spells->setType($type = '' ? null : $type);
            $range = $request->request->get('range');
            $Spells->setRange($range = '' ? null : $range);
            $target = $request->request->get('target');
            $Spells->setTarget($target = '' ? null : $target);
            $length = $request->request->get('length');
            $Spells->setLength($length = '' ? null : $length);
            $damage = $request->request->get('damage');
            $Spells->setDamage($damage = '' ? null : $damage);
            $desc = $request->request->get('desc');
            $Spells->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Spells->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Spells);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteSpells', name: 'deleteSpells', methods : ['POST'])]
    public function deleteSpells(ManagerRegistry $doctrine, Request $request){
        $Spells = $doctrine->getRepository(Spells::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Spells);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
