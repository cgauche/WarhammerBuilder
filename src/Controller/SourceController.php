<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SourceType;
use App\Entity\Source;

class SourceController extends AbstractController
{
    #[Route('/admin/editSource', name: 'editSource')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('source/index.html.twig');
    }
    
    #[Route('/admin/readAllSources', name: 'readAllSources', methods : ['POST'])]
    public function readAllSources(ManagerRegistry $doctrine){
        $sources = $doctrine->getRepository(Source::class)->findAll();
        
        return new Response($this->renderView('source/tableSource.html.twig',['sources' => $sources]));
    }

    #[Route('/admin/createSource', name: 'createSource', methods : ['POST'])]
    public function createSource(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $source = new Source();
            $source->setName($request->request->get('name'));
            $source->setYear($request->request->get('year'));
            $isbn = $request->request->get('isbn');
            $source->setISBN($isbn == '' ? null : $isbn);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($source);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readSource', name : 'readSource', methods : ['POST'])]
    public function readSource(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $source = $doctrine->getRepository(Source::class)->find($id);
        }else{
            $source = new Source();
        }

        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(SourceType::class, $source)
        ]);
    }

    #[Route('/admin/updateSource', name: 'updateSource', methods : ['POST'])]
    public function updateSource(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $source = $doctrine->getRepository(Source::class)->find($request->request->get('id'));
            $source->setName($request->request->get('name'));
            $source->setYear($request->request->get('year'));
            $isbn = $request->request->get('isbn');
            $source->setISBN($isbn == '' ? null : $isbn);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($source);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteSource', name: 'deleteSource', methods : ['POST'])]
    public function deleteSource(ManagerRegistry $doctrine, Request $request){
        $source = $doctrine->getRepository(Source::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($source);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
