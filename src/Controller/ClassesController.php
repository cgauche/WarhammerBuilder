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
use App\Entity\ClassTrapping;
use App\Entity\Trapping;
use App\Entity\BagsContainers;
use App\Entity\Armoury;

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

    /*************************************************************
    * GESTION DES POSSESSIONS PAR DEFAUT (ClassTrapping)
    *************************************************************/

    #[Route('/admin/readClassTrapping', name : 'readClassTrapping', methods : ['POST'])]
    public function readClassTrapping(ManagerRegistry $doctrine, Request $request){
        $listT = $doctrine->getRepository(Trapping::class)->findAll();
        $listBC = $doctrine->getRepository(BagsContainers::class)->findAll();
        $listA = $doctrine->getRepository(Armoury::class)->findAll();
        
        $result = [];
        $ClassTrapping = $doctrine->getRepository(ClassTrapping::class)->findBy(['idClasses' => $request->request->get('id')]);
        foreach ($ClassTrapping as $ct) {
            $result[] = [
                'id' => $ct->getId(),
                'type' => $ct->getType(),
                'tID' => $ct->getIdTrapping(),
                'qte' => $ct->getQte()
            ];
        }

        return new Response($this->renderView('classes/tableClassTrapping.html.twig',[
            'trappings' => $result,
            'listT' => $listT,
            'listBC' => $listBC,
            'listA' => $listA
        ]));
    }

    #[Route('/admin/getAllTrapping', name : 'getAllTrapping', methods : ['POST'])]
    public function getAllTrapping(ManagerRegistry $doctrine, Request $request){
        $result = [];
       
        $temp = [];
        $Trapping = $doctrine->getRepository(Trapping::class)->findAll();
        foreach ($Trapping as $t) {
            $temp[] = [
                'id' => 'T/'.$t->getId(),
                'name' => $t->getName()
            ];
        }
        $result[] = [
            'name' => "Items",
            'data' => $temp
        ];

        $temp = [];
        $Bags = $doctrine->getRepository(BagsContainers::class)->findAll();
        foreach ($Bags as $bc) {
            $temp[] = [
                'id' => 'B/'.$bc->getId(),
                'name' => $bc->getName()
            ];
        }
        $result[] = [
            'name' => "Sacs",
            'data' => $temp
        ];

        $temp = [];
        $Armoury = $doctrine->getRepository(Armoury::class)->findAll();
        foreach ($Armoury as $a) {
            $temp[] = [
                'id' => 'A/'.$a->getId(),
                'name' => $a->getName()
            ];
        }
        $result[] = [
            'name' => "Armes & armures",
            'data' => $temp
        ];
        return new JSONResponse($result);
    }

    #[Route('/admin/deleteClassTrapping', name : 'deleteClassTrapping', methods : ['POST'])]
    public function deleteClassTrapping(ManagerRegistry $doctrine, Request $request){
        $ct = $doctrine->getRepository(ClassTrapping::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($ct);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/saveClassTrapping', name : 'saveClassTrapping', methods : ['POST'])]
    public function saveClassTrapping(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $ct = $doctrine->getRepository(ClassTrapping::class)->find($d['id']);
            }else{
                $ct = new ClassTrapping();
            }
            $ct->setIdClasses($request->request->get('id'));
            $ct->setIdTrapping($d['idT']);
            $ct->setType($d['type']);
            $ct->setQte($d['qte']);
            $entityManager->persist($ct);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

}
