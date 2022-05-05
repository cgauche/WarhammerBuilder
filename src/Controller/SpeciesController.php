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
use App\Entity\CharacSpecies;
use App\Entity\CareersSpecies;
use App\Entity\Careers;
use App\Entity\Characteristics;
use App\Entity\Skills;
use App\Entity\SkillsSpecies;
use App\Entity\Talents;
use App\Entity\TalentsSpecies;

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
            $specie->setRollmax($rollmax == '' ? $request->request->get('rollmin') : $rollmax);
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

    /*************************************************************
    * GESTION DES CARACTERISTIQUES DE BASE (CharacSpecies)
    *************************************************************/

    #[Route('/admin/readBaseCharac', name : 'readBaseCharac', methods : ['POST'])]
    public function readBaseCharac(ManagerRegistry $doctrine, Request $request){
        $characs = $doctrine->getRepository(Characteristics::class)->findAll();
        $result = [];
        foreach ($characs as $c) {
            $idSPC = null;
            $base = null;
            $roll = null ;

            $spc = $doctrine->getRepository(CharacSpecies::class)->findOneBy([
                'idSpecies' => $request->request->get('id'),
                'idCharac' => $c->getId()
            ]);
            if($spc != null){
                $idSPC = $spc->getId();
                $base = $spc->getBase();
                $roll = $spc->getNbRoll();
            }

            $result[] = [
                'id' => $idSPC == null ? "-" . $c->getId() : $idSPC,
                'name' => $c->getName(),
                'base' => $base,
                'nbRoll' => $roll
            ];
        }

        return new Response($this->renderView('Species/tableSpeciesCharac.html.twig',['characs' => $result]));
    }

    #[Route('/admin/saveBaseCharac', name : 'saveBaseCharac', methods : ['POST'])]
    public function saveBaseCharac(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            $spc = $doctrine->getRepository(CharacSpecies::class)->find($d['ID']);
            if($spc == null){
                $spc = new CharacSpecies();
                $spc->setIdCharac(abs($d['ID']));
                $spc->setIdSpecies($request->request->get('id'));
            }
            $spc->setBase($d['base']);
            $spc->setNbRoll($d['roll']);
            $entityManager->persist($spc);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES CARRIERES ACCESSIBLES (CareersSpecies)
    *************************************************************/

    #[Route('/admin/readAccesCareers', name : 'readAccesCareers', methods : ['POST'])]
    public function readAccesCareers(ManagerRegistry $doctrine, Request $request){
        $careers = $doctrine->getRepository(Careers::class)->findAll();
        $result = [];
        foreach ($careers as $c) {
            $idSPC = null;
            $value = false;
            $minRoll = null;
            $maxRoll = null;

            $spc = $doctrine->getRepository(CareersSpecies::class)->findOneBy([
                'idSpecies' => $request->request->get('id'),
                'idCareers' => $c->getId()
            ]);
            if($spc != null){
                $idSPC = $spc->getId();
                $value = true;
                $minRoll = $spc->getMin();
                $maxRoll = $spc->getMax();
            }

            $result[] = [
                'id' => $idSPC == null ? "-" . $c->getId() : $idSPC,
                'name' => $c->getName(),
                'value' => $value,
                'minRoll' => $minRoll,
                'maxRoll' => $maxRoll
            ];
        }

        return new Response($this->renderView('Species/tableSpeciesCareers.html.twig',['careers' => $result]));
    }

    #[Route('/admin/saveAccesCareers', name : 'saveAccesCareers', methods : ['POST'])]
    public function saveAccesCareers(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['value']){
                $spc = $doctrine->getRepository(CareersSpecies::class)->find($d['ID']);
                if($d['ID'] <= 0){
                    $spc = new CareersSpecies();
                    $spc->setIdCareers(abs($d['ID']));
                    $spc->setIdSpecies($request->request->get('id'));
                }
                $spc->setMin($d['minRoll']);
                $spc->setMax($d['maxRoll']);
                $entityManager->persist($spc);
            }else{
                $spc = $doctrine->getRepository(CareersSpecies::class)->find($d['ID']);
                if($spc != null)
                    $entityManager->remove($spc);
            }
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES COMPETENCES PAR DEFAUT (SkillsSpecies)
    *************************************************************/

    #[Route('/admin/readSkillsSpecies', name : 'readSkillsSpecies', methods : ['POST'])]
    public function readSkillsSpecies(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $listS = $doctrine->getRepository(Skills::class)->findAll();
        $SkillsSpecies = $doctrine->getRepository(SkillsSpecies::class)->findBy([
            'idSpecies' => $request->request->get('id')
        ]);

        foreach ($SkillsSpecies as $sksp) {
            $result[] = [
                'id' => $sksp->getId(),
                'sID' => $sksp->getIdSkills(),
                'specs' => $sksp->getSpecs()
            ];
        }

        return new Response($this->renderView('Species/tableSpeciesSkills.html.twig',[
            'skills' => $result,
            'listS' => $listS
        ]));
    }

    #[Route('/admin/getAllSkills', name : 'getAllSkills', methods : ['POST'])]
    public function getAllSkills(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $skills = $doctrine->getRepository(Skills::class)->findAll();
        foreach ($skills as $skill) {
            $result[] = [
                'id' => $skill->getId(),
                'name' => $skill->getName()
            ];
        }
        return new JSONResponse($result);
    }

    #[Route('/admin/deleteSkillsSpecies', name : 'deleteSkillsSpecies', methods : ['POST'])]
    public function deleteSkillsSpecies(ManagerRegistry $doctrine, Request $request){
        $sksp = $doctrine->getRepository(SkillsSpecies::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($sksp);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/haveSpecs', name : 'haveSpecs', methods : ['POST'])]
    public function haveSpecs(ManagerRegistry $doctrine, Request $request){
        $skill = $doctrine->getRepository(Skills::class)->find($request->request->get('id'));
        return new JSONResponse(['result' => $skill->getSpecs() != '']);
    }

    #[Route('/admin/saveSkillsSpecies', name : 'saveSkillsSpecies', methods : ['POST'])]
    public function saveSkillsSpecies(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $sksp = $doctrine->getRepository(SkillsSpecies::class)->find($d['id']);
            }else{
                $sksp = new SkillsSpecies();
            }
            $sksp->setIdSkills($d['idS']);
            $sksp->setIdSpecies($request->request->get('id'));
            $sksp->setSpecs($d['specs']);
            $entityManager->persist($sksp);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES TALENTS PAR DEFAUT (TalentsSpecies)
    *************************************************************/

    #[Route('/admin/readTalentsSpecies', name : 'readTalentsSpecies', methods : ['POST'])]
    public function readTalentsSpecies(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $listT = $doctrine->getRepository(Talents::class)->findAll();
        $TalentsSpecies = $doctrine->getRepository(TalentsSpecies::class)->findBy([
            'idSpecies' => $request->request->get('id')
        ]);

        foreach ($TalentsSpecies as $tsp) {
            $result[] = [
                'id' => $tsp->getId(),
                'tID' => $tsp->getIdTalents(),
                'specs' => $tsp->getSpecs(),
                'tID2' => $tsp->getIdTalentsSec(),
                'specs2' => $tsp->getSpecsSec()
            ];
        }

        return new Response($this->renderView('Species/tableSpeciesTalents.html.twig',[
            'talents' => $result,
            'listT' => $listT
        ]));
    }
    
    #[Route('/admin/talentSpecs', name : 'talentSpecs', methods : ['POST'])]
    public function talentSpecs(ManagerRegistry $doctrine, Request $request){
        $talent = $doctrine->getRepository(Talents::class)->find($request->request->get('id'));
        return new JSONResponse(['result' => $talent->getSpecs() != '']);
    }

    #[Route('/admin/getAllTalents', name : 'getAllTalents', methods : ['POST'])]
    public function getAllTalents(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $talents = $doctrine->getRepository(Talents::class)->findAll();
        foreach ($talents as $talent) {
            $result[] = [
                'id' => $talent->getId(),
                'name' => $talent->getName()
            ];
        }
        return new JSONResponse($result);
    }

    #[Route('/admin/deleteTalentsSpecies', name : 'deleteTalentsSpecies', methods : ['POST'])]
    public function deleteTalentsSpecies(ManagerRegistry $doctrine, Request $request){
        $tsp = $doctrine->getRepository(TalentsSpecies::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($tsp);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/saveTalentsSpecies', name : 'saveTalentsSpecies', methods : ['POST'])]
    public function saveTalentsSpecies(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $tsp = $doctrine->getRepository(TalentsSpecies::class)->find($d['id']);
            }else{
                $tsp = new TalentsSpecies();
            }
            $tsp->setIdSpecies($request->request->get('id'));
            $tsp->setIdTalents($d['idS']);
            $tsp->setSpecs($d['specs']);
            $tsp->setIdTalentsSec($d['idS2']);
            $tsp->setSpecsSec($d['specs2']);
            $entityManager->persist($tsp);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

}
