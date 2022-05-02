<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CareersType;
use App\Entity\Careers;
use App\Entity\Source;
use App\Entity\Classes;

class CareersController extends AbstractController
{
    #[Route('/admin/editCareers', name: 'editCareers')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('Careers/index.html.twig');
    }
    
    #[Route('/admin/readAllCareers', name: 'readAllCareers', methods : ['POST'])]
    public function readAllCareers(ManagerRegistry $doctrine){
        $Careers = $doctrine->getRepository(Careers::class)->findAll();
        $result = [];
        foreach ($Careers as $c) {
            $source = null;
            if($c->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($c->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }
            $classe = null;
            if($c->getIdClass() != null){
                $classe = $doctrine->getRepository(Classes::class)->find($c->getIdClass());
                if($classe != null){
                    $classe = $classe->getName();
                }
            }

            $result[] = [
                'id' => $c->getId(),
                'name' => $c->getName(),
                'resume' => $c->getResume(),
                'classe' => $classe,
                'source' => $source
            ];
        }

        return new Response($this->renderView('careers/tableCareers.html.twig',['careers' => $result]));
    }

    #[Route('/admin/createCareers', name: 'createCareers', methods : ['POST'])]
    public function createCareers(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $career = new Careers();
            $career->setName($request->request->get('name'));
            $career->setIdClass($request->request->get('idClasse'));

            $desc = $request->request->get('desc');
            $career->setDescription($desc == '' ? null : $desc);
            $resume = $request->request->get('resume');
            $career->setResume($resume == '' ? null : $resume);
            $idSource = $request->request->get('idSource');
            $career->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($career);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readCareers', name : 'readCareers', methods : ['POST'])]
    public function readCareers(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $career = $doctrine->getRepository(Careers::class)->find($id);
        }else{
            $career = new Careers();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(CareersType::class, $career)
        ]);
    }

    #[Route('/admin/updateCareers', name: 'updateCareers', methods : ['POST'])]
    public function updateCareers(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $career = $doctrine->getRepository(Careers::class)->find($request->request->get('id'));
            $career->setName($request->request->get('name'));
            $career->setIdClass($request->request->get('idClasse'));

            $desc = $request->request->get('desc');
            $career->setDescription($desc == '' ? null : $desc);
            $resume = $request->request->get('resume');
            $career->setResume($resume == '' ? null : $resume);
            $idSource = $request->request->get('idSource');
            $career->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($career);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteCareers', name: 'deleteCareers', methods : ['POST'])]
    public function deleteCareers(ManagerRegistry $doctrine, Request $request){
        $career = $doctrine->getRepository(Careers::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($career);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
