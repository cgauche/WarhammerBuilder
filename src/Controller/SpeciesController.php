<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SpeciesType;
use App\Entity\Species;
use App\Entity\Source;

class SpeciesController extends AbstractController
{
    #[Route('/admin/editSpecies', name: 'editSpecies')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('species/index.html.twig');
    }
    
    #[Route('/admin/readAllSpecies', name: 'readAllSpecies', methods : ['POST'])]
    public function readAllSpecies(ManagerRegistry $doctrine){
        $Species = $doctrine->getRepository(Species::class)->findAll();
        $result = [];
        foreach ($Species as $s) {
            $source = null;
            if($s->getIdSource() != null){
                $source = $doctrine->getRepository(Source::class)->find($s->getIdSource());
                if($source != null){
                    $source = $source->getName();
                }
            }

            $result[] = [
                'id' => $s->getId(),
                'name' => $s->getName(),
                'range' => $s->getRollmin() . " - " . $s->getRollmax(),
                'desc' => $s->getDescription(),
                'age' => $s->getAge() . " + " . $s->getRollage() . "D10",
                'heigth' => $s->getHeight() . " + " . $s->getRollheight() . "D10",
                'randomTalent' => $s->getRandomtalents(),
                'fate' => $s->getFate(),
                'resilience' => $s->getResilience(),
                'fr_extra' => $s->getFrSpend(),
                'source' => $source
            ];
        }

        return new Response($this->renderView('Species/tableSpecies.html.twig',['species' => $result]));
    }

    #[Route('/admin/createSpecies', name: 'createSpecies', methods : ['POST'])]
    public function createSpecies(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $specie = new Species();
            $specie->setName($request->request->get('name'));
            $specie->setRollmin($request->request->get('rollmin'));
            $specie->setFate($request->request->get('fate'));
            $specie->setResilience($request->request->get('resilience'));
            $specie->setFrspend($request->request->get('frSpend'));

            $desc = $request->request->get('desc');
            $specie->setDescription($desc == '' ? null : $desc);
            $rollmax = $request->request->get('rollmax');
            $specie->setRollmax($rollmax == '' ? null : $rollmax);
            $randomtalents = $request->request->get('randomtalents');
            $specie->setRandomtalents($randomtalents == '' ? null : $randomtalents);
            $age = $request->request->get('age');
            $specie->setAge($age == '' ? null : $age);
            $rollage = $request->request->get('rollage');
            $specie->setRollage($rollage == '' ? null : $rollage);
            $height = $request->request->get('height');
            $specie->setHeight($height == '' ? null : $height);
            $rollheight = $request->request->get('rollheight');
            $specie->setRollheight($rollheight == '' ? null : $rollheight);
            $idSource = $request->request->get('idSource');
            $specie->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($specie);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readSpecies', name : 'readSpecies', methods : ['POST'])]
    public function readSpecies(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $specie = $doctrine->getRepository(Species::class)->find($id);
        }else{
            $specie = new Species();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(SpeciesType::class, $specie)
        ]);
    }

    #[Route('/admin/updateSpecies', name: 'updateSpecies', methods : ['POST'])]
    public function updateSpecies(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $specie = $doctrine->getRepository(Species::class)->find($request->request->get('id'));
            $specie->setName($request->request->get('name'));
            $specie->setRollmin($request->request->get('rollmin'));
            $specie->setFate($request->request->get('fate'));
            $specie->setResilience($request->request->get('resilience'));
            $specie->setFrspend($request->request->get('frSpend'));

            $desc = $request->request->get('desc');
            $specie->setDescription($desc == '' ? null : $desc);
            $rollmax = $request->request->get('rollmax');
            $specie->setRollmax($rollmax == '' ? null : $rollmax);
            $randomtalents = $request->request->get('randomtalents');
            $specie->setRandomtalents($randomtalents == '' ? null : $randomtalents);
            $age = $request->request->get('age');
            $specie->setAge($age == '' ? null : $age);
            $rollage = $request->request->get('rollage');
            $specie->setRollage($rollage == '' ? null : $rollage);
            $height = $request->request->get('height');
            $specie->setHeight($height == '' ? null : $height);
            $rollheight = $request->request->get('rollheight');
            $specie->setRollheight($rollheight == '' ? null : $rollheight);
            $idSource = $request->request->get('idSource');
            $specie->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($specie);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteSpecies', name: 'deleteSpecies', methods : ['POST'])]
    public function deleteSpecies(ManagerRegistry $doctrine, Request $request){
        $specie = $doctrine->getRepository(Species::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($specie);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
