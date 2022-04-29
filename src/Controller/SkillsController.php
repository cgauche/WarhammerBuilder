<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SkillsType;
use App\Entity\Characteristics;
use App\Entity\Skills;
use App\Entity\Source;

class SkillsController extends AbstractController
{
    #[Route('/admin/editSkills', name: 'editSkills')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('Skills/index.html.twig');
    }
    
    #[Route('/admin/readAllSkills', name: 'readAllSkills', methods : ['POST'])]
    public function readAllSkills(ManagerRegistry $doctrine){
        $Skills = $doctrine->getRepository(Skills::class)->findAll();
        $result = [];
        foreach ($Skills as $s) {
            $source = null;
            if($s->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($s->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }
            $Charac = null;
            if($s->getIdCaracteristics() != null){
                $Charac = $doctrine->getRepository(Characteristics::class)->find($s->getIdCaracteristics());
                if($Charac != null){
                    $Charac = $Charac->getName();
                }
            }

            $type = null;
            switch ($s->getType()) {
                case 1 : $type = 'Base' ; break;
                case 2 : $type = 'Avancée' ; break;
                default: break;
            }

            $result[] = [
                'id' => $s->getId(),
                'name' => $s->getName(),
                'type' => $type,
                'specs' => $s->getSpecs(),
                'charac' => $Charac,
                'source' => $source
            ];
        }

        return new Response($this->renderView('Skills/tableSkills.html.twig',['skills' => $result]));
    }

    #[Route('/admin/createSkills', name: 'createSkills', methods : ['POST'])]
    public function createSkills(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Skills = new Skills();
            $Skills->setName($request->request->get('name'));
            $Skills->setType($request->request->get('type'));
            $Skills->setIdCaracteristics($request->request->get('idCharac'));

            $specs = $request->request->get('specs');
            $Skills->setspecs($specs == '' ? null : $specs);
            $desc = $request->request->get('description');
            $Skills->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Skills->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Skills);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readSkills', name : 'readSkills', methods : ['POST'])]
    public function readSkills(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Skills = $doctrine->getRepository(Skills::class)->find($id);
        }else{
            $Skills = new Skills();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(SkillsType::class, $Skills)
        ]);
    }

    #[Route('/admin/updateSkills', name: 'updateSkills', methods : ['POST'])]
    public function updateSkills(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Skills = $doctrine->getRepository(Skills::class)->find($request->request->get('id'));
            $Skills->setName($request->request->get('name'));
            $Skills->setType($request->request->get('type'));
            $Skills->setIdCaracteristics($request->request->get('idCharac'));

            $specs = $request->request->get('specs');
            $Skills->setspecs($specs == '' ? null : $specs);
            $desc = $request->request->get('description');
            $Skills->setDescription($desc == '' ? null : $desc);
            $idSource = $request->request->get('idSource');
            $Skills->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Skills);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteSkills', name: 'deleteSkills', methods : ['POST'])]
    public function deleteSkills(ManagerRegistry $doctrine, Request $request){
        $Skills = $doctrine->getRepository(Skills::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Skills);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
