<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Source;
use App\Entity\Armoury;
use App\Entity\WAttrArmoury;
use App\Entity\WeaponAttr;
use App\Form\ArmouryType;

class ArmouryController extends AbstractController
{
    #[Route('/admin/editArmoury', name: 'editArmoury')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('armoury/index.html.twig', [
            'WAttr' => $doctrine->getRepository(WeaponAttr::class)->findAll()
        ]);
    }
    
    #[Route('/admin/readAllArmoury', name: 'readAllArmoury', methods : ['POST'])]
    public function readAllArmoury(ManagerRegistry $doctrine){
        $Armoury = $doctrine->getRepository(Armoury::class)->findAll();
        $result = [];
        foreach ($Armoury as $arm) {
            $source = null;
            if($arm->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($arm->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }
            
            $result[] = [
                
                'id' => $arm->getId(),
                'name' => $arm->getName(),
                'type' => $arm->getType(),
                'group' => $arm->getGroup(),
                'price' => $arm->getPrice(),
                'clutter' => $arm->getClutter(),
                'availability' => $arm->getAvailability(),
                'range' => $arm->getRange(),
                'damage' => $arm->getDamage(),
                'pa' => $arm->getPA(),
                'source' => $source
            ];
        }
        
        return new Response($this->renderView('armoury/tableArmoury.html.twig',['armoury' => $result]));
    }
    
    #[Route('/admin/createArmoury', name: 'createArmoury', methods : ['POST'])]
    public function createArmoury(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $arm = new Armoury();
            $arm->setName($request->request->get('name'));
            $arm->setType($request->request->get('type'));
            $arm->setClutter($request->request->get('clutter'));
            
            $group = $request->request->get('group');
            $arm->setGroup($group == '' ? null : $group);
            $price = $request->request->get('price');
            $arm->setPrice($price == '' ? null : $price);
            $availability = $request->request->get('availability');
            $arm->setAvailability($availability == '' ? null : $availability);
            $range = $request->request->get('range');
            $arm->setRange($range == '' ? null : $range);
            $damage = $request->request->get('damage');
            $arm->setDamage($damage == '' ? null : $damage);
            $penalty = $request->request->get('penalty');
            $arm->setPenalty($penalty == '' ? null : $penalty);
            $location = $request->request->get('location');
            $arm->setLocation($location == '' ? null : $location);
            $pa = $request->request->get('pa');
            $arm->setPa($pa == '' ? null : $pa);
            $desc = $request->request->get('desc');
            $arm->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $arm->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($arm);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/readArmoury', name : 'readArmoury', methods : ['POST'])]
    public function readArmoury(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $creation = false;
            $arm = $doctrine->getRepository(Armoury::class)->find($id);
        }else{
            $creation = true;
            $arm = new Armoury();
        }
        
        return $this->render('armoury/formArmoury.html.twig', [
            'form' => $this->createForm(ArmouryType::class, $arm)->createView(),
            'creation' => $creation
        ]);
    }
    
    #[Route('/admin/updateArmoury', name: 'updateArmoury', methods : ['POST'])]
    public function updateArmoury(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $arm = $doctrine->getRepository(Armoury::class)->find($request->request->get('id'));
            $arm->setName($request->request->get('name'));
            $arm->setType($request->request->get('type'));
            $arm->setClutter($request->request->get('clutter'));
            
            $group = $request->request->get('group');
            $arm->setGroup($group == '' ? null : $group);
            $price = $request->request->get('price');
            $arm->setPrice($price == '' ? null : $price);
            $availability = $request->request->get('availability');
            $arm->setAvailability($availability == '' ? null : $availability);
            $range = $request->request->get('range');
            $arm->setRange($range == '' ? null : $range);
            $damage = $request->request->get('damage');
            $arm->setDamage($damage == '' ? null : $damage);
            $penalty = $request->request->get('penalty');
            $arm->setPenalty($penalty == '' ? null : $penalty);
            $location = $request->request->get('location');
            $arm->setLocation($location == '' ? null : $location);
            $pa = $request->request->get('pa');
            $arm->setPa($pa == '' ? null : $pa);
            $desc = $request->request->get('desc');
            $arm->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $arm->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($arm);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/deleteArmoury', name: 'deleteArmoury', methods : ['POST'])]
    public function deleteArmoury(ManagerRegistry $doctrine, Request $request){
        $arm = $doctrine->getRepository(Armoury::class)->find($request->request->get('id'));
        $WAttrArmoury = $doctrine->getRepository(WAttrArmoury::class)->findBy(['idArmoury' => $request->request->get('id')]);
        
        $entityManager = $doctrine->getManager();
        foreach ($WAttrArmoury as $waa) {
            $entityManager->remove($waa);
        }
        $entityManager->remove($arm);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
    
    /*************************************************************
    * GESTION DES ATTRIBUTS DES EQUIPPEMENTS (WEAPONATTR)
    *************************************************************/
    
    #[Route('/admin/readAllWAArmoury', name: 'readAllWAArmoury', methods : ['POST'])]
    public function readAllWAArmoury(ManagerRegistry $doctrine, Request $request){
        $WAttrArmoury = $doctrine->getRepository(WAttrArmoury::class)->findBy(['idArmoury' => $request->request->get('id')]);
        $result = [];
        foreach ($WAttrArmoury as $waa) {
            $WAttr = null;
            if($waa->getIdWeaponAttr() != null){
                $WAttr = $doctrine->getRepository(WeaponAttr::class)->find($waa->getIdWeaponAttr());
                if($WAttr != null){
                    $WAttr = $WAttr->getName() . ($WAttr->getWithRank() ? " " . $waa->getRank() : "");
                }
            }
            
            $result[] = [
                'id' => $waa->getId(),
                'name' => $WAttr
            ];
        }
        
        return new Response($this->renderView('armoury/tableWAttr.html.twig',['WAttrArmoury' => $result]));
    }
    
    #[Route('/admin/createWAArmoury', name: 'createWAArmoury', methods : ['POST'])]
    public function createWAArmoury(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $arm = new WAttrArmoury();
            $arm->setIdWeaponAttr($request->request->get('idWAttr'));
            $arm->setIdArmoury($request->request->get('idArmoury'));

            $rank = $request->request->get('rank');
            $arm->setRank($rank == '' ? null : $rank);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($arm);
            $entityManager->flush();
            
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/readWAArmoury', name : 'readWAArmoury', methods : ['POST'])]
    public function readWAArmoury(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $waa = $doctrine->getRepository(WAttrArmoury::class)->find($id);
            if($waa != null){
                $wattr = $doctrine->getRepository(WeaponAttr::class)->find($waa->getIdWeaponAttr());
                $withRank = false;
                if ($wattr != null) {
                    $withRank = $wattr->getWithRank();
                }
                return new JSONResponse([
                    'id' => $waa->getIdWeaponAttr(),
                    'withRank' => $withRank,
                    'rank' => $waa->getRank()
                ]);
            }
        }
        return new JSONResponse();
    }
    
    #[Route('/admin/haveRank', name : 'haveRank', methods : ['POST'])]
    public function haveRank(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $wattr = $doctrine->getRepository(WeaponAttr::class)->find($id);
            if ($wattr != null) {
                return new JSONResponse(['result' => $wattr->getWithRank()]);
            }
        }
        return new JSONResponse();
    }
    
    #[Route('/admin/updateWAArmoury', name: 'updateWAArmoury', methods : ['POST'])]
    public function updateWAArmoury(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $arm = $doctrine->getRepository(WAttrArmoury::class)->find($request->request->get('id'));
            $arm->setIdWeaponAttr($request->request->get('idWAttr'));

            $rank = $request->request->get('rank');
            $arm->setRank($rank == '' ? null : $rank);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($arm);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/deleteWAArmoury', name: 'deleteWAArmoury', methods : ['POST'])]
    public function deleteWAArmoury(ManagerRegistry $doctrine, Request $request){
        $arm = $doctrine->getRepository(WAttrArmoury::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($arm);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
