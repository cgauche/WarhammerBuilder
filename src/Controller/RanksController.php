<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\RanksType;
use App\Entity\Ranks;
use App\Entity\TrappingRank;
use App\Entity\Careers;
use App\Entity\Characteristics;
use App\Entity\Skills;
use App\Entity\SkillsRank;
use App\Entity\Talents;
use App\Entity\TalentsRank;
use App\Entity\Trapping;
use App\Entity\BagsContainers;
use App\Entity\Armoury;

class RanksController extends AbstractController
{

    #[Route('/admin/editCareers/Ranks/{id}', name: 'editRanks')]
    public function editRanks(ManagerRegistry $doctrine, string $id){
        $nameC = $doctrine->getRepository(Careers::class)->find($id)->getName();
        return new Response($this->renderView('Ranks/index.html.twig', [
            'id' => $id,
            'nameC' => $nameC
        ]));
    }

    #[Route('/admin/readCareersRanks', name: 'readCareersRanks', methods : ['POST'])]
    public function readCareersRanks(ManagerRegistry $doctrine, Request $request){
        $Ranks = $doctrine->getRepository(Ranks::class)->findBy(['idCareer' => $request->request->get('id')]);
        $result = [];
        foreach ($Ranks as $r) {
            $tmp = null;
            $nameC = '';
            if($r->getIdCharac() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac());
                if($tmp != null){
                    $nameC = $tmp->getName();
                }
            }
            if($r->getIdCharac2() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac2());
                if($tmp != null){
                    $nameC = ($nameC != '' ? $nameC . ', ' : '') . $tmp->getName();
                }
            }
            if($r->getIdCharac3() != null){                
                $tmp = $doctrine->getRepository(Characteristics::class)->find($r->getIdCharac3());
                if($tmp != null){
                    $nameC = ($nameC != '' ? $nameC . ', ' : '') . $tmp->getName();
                }
            }

            $result[] = [
                'id' => $r->getId(),
                'name' => $r->getName(),
                'status' => $r->getStatus(),
                'charac' => $nameC
            ];
        }
        return new Response($this->renderView('Ranks/tableRanks.html.twig',['ranks' => $result]));
    }

    #[Route('/admin/createRanks', name: 'createRanks', methods : ['POST'])]
    public function createRanks(ManagerRegistry $doctrine, Request $request) {
        if($request->isXmlHttpRequest()){
            $Ranks = new Ranks();
            $Ranks->setName($request->request->get('name'));
            $Ranks->setStatus($request->request->get('status'));
            $Ranks->setIdCareer($request->request->get('id'));
            $Ranks->setIdCharac($request->request->get('idCharac'));
            
            $idC2 = $request->request->get('idCharac2');
            $Ranks->setIdCharac2($idC2 == '' ? null : $idC2);
            $idC3 = $request->request->get('idCharac3');
            $Ranks->setIdCharac3($idC3 == '' ? null : $idC3);
            $idSource = $request->request->get('idSource');
            $Ranks->setIdSource($idSource == '' ? null : $idSource);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($Ranks);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/readRanks', name : 'readRanks', methods : ['POST'])]
    public function readRanks(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $Ranks = $doctrine->getRepository(Ranks::class)->find($id);
        }else{
            $Ranks = new Ranks();
        }
    
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(RanksType::class, $Ranks)
        ]);
    }

    #[Route('/admin/updateRanks', name: 'updateRanks', methods : ['POST'])]
    public function updateRanks(ManagerRegistry $doctrine, Request $request){
        if($request->isXmlHttpRequest()){
            $Ranks = $doctrine->getRepository(Ranks::class)->find($request->request->get('id'));
            $Ranks->setName($request->request->get('name'));
            $Ranks->setStatus($request->request->get('status'));
            $Ranks->setIdCharac($request->request->get('idCharac'));
            
            $idC2 = $request->request->get('idCharac2');
            $Ranks->setIdCharac2($idC2 == '' ? null : $idC2);
            $idC3 = $request->request->get('idCharac3');
            $Ranks->setIdCharac3($idC3 == '' ? null : $idC3);
            $idSource = $request->request->get('idSource');
            $Ranks->setIdSource($idSource == '' ? null : $idSource);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Ranks);
            $entityManager->flush();
            return new JSONResponse(['result' => "OK"]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }

    #[Route('/admin/deleteRanks', name: 'deleteRanks', methods : ['POST'])]
    public function deleteRanks(ManagerRegistry $doctrine, Request $request){
        $Ranks = $doctrine->getRepository(Ranks::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($Ranks);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES COMPETENCES POSSIBLES (SkillsRank)
    *************************************************************/

    #[Route('/admin/readSkillsRanks', name : 'readSkillsRanks', methods : ['POST'])]
    public function readSkillsRanks(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $listS = $doctrine->getRepository(Skills::class)->findAll();
        $SkillsRank = $doctrine->getRepository(SkillsRank::class)->findBy([
            'idRanks' => $request->request->get('id')
        ]);

        foreach ($SkillsRank as $sksp) {
            $result[] = [
                'id' => $sksp->getId(),
                'sID' => $sksp->getIdSkills(),
                'specs' => $sksp->getSpecs()
            ];
        }

        return new Response($this->renderView('ranks/tableRanksSkills.html.twig',[
            'skills' => $result,
            'listS' => $listS
        ]));
    }

    #[Route('/admin/deleteSkillsRanks', name : 'deleteSkillsRanks', methods : ['POST'])]
    public function deleteSkillsRanks(ManagerRegistry $doctrine, Request $request){
        $sksp = $doctrine->getRepository(SkillsRank::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($sksp);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/saveSkillsRanks', name : 'saveSkillsRanks', methods : ['POST'])]
    public function saveSkillsRanks(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $sksp = $doctrine->getRepository(SkillsRank::class)->find($d['id']);
            }else{
                $sksp = new SkillsRank();
            }
            $sksp->setIdSkills($d['idS']);
            $sksp->setIdRanks($request->request->get('id'));
            $sksp->setSpecs($d['specs']);
            $entityManager->persist($sksp);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES TALENTS POSSIBLES (TalentsRank)
    *************************************************************/

    #[Route('/admin/readTalentsRanks', name : 'readTalentsRanks', methods : ['POST'])]
    public function readTalentsRanks(ManagerRegistry $doctrine, Request $request){
        $result = [];
        $listT = $doctrine->getRepository(Talents::class)->findAll();
        $TalentsRank = $doctrine->getRepository(TalentsRank::class)->findBy([
            'idRanks' => $request->request->get('id')
        ]);

        foreach ($TalentsRank as $tsp) {
            $result[] = [
                'id' => $tsp->getId(),
                'tID' => $tsp->getIdTalents(),
                'specs' => $tsp->getSpecs()
            ];
        }

        return new Response($this->renderView('ranks/tableRanksTalents.html.twig',[
            'talents' => $result,
            'listT' => $listT
        ]));
    }

    #[Route('/admin/deleteTalentsRanks', name : 'deleteTalentsRanks', methods : ['POST'])]
    public function deleteTalentsRanks(ManagerRegistry $doctrine, Request $request){
        $tsp = $doctrine->getRepository(TalentsRank::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($tsp);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/saveTalentsRanks', name : 'saveTalentsRanks', methods : ['POST'])]
    public function saveTalentsRanks(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $tsp = $doctrine->getRepository(TalentsRank::class)->find($d['id']);
            }else{
                $tsp = new TalentsRank();
            }
            $tsp->setIdRanks($request->request->get('id'));
            $tsp->setIdTalents($d['idS']);
            $tsp->setSpecs($d['specs']);
            $entityManager->persist($tsp);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }

    /*************************************************************
    * GESTION DES POSSESSIONS (TrappingRank)
    *************************************************************/

    #[Route('/admin/readRanksTrapping', name : 'readRanksTrapping', methods : ['POST'])]
    public function readRanksTrapping(ManagerRegistry $doctrine, Request $request){
        $listT = $doctrine->getRepository(Trapping::class)->findAll();
        $listBC = $doctrine->getRepository(BagsContainers::class)->findAll();
        $listA = $doctrine->getRepository(Armoury::class)->findAll();
        
        $result = [];
        $ClassTrapping = $doctrine->getRepository(TrappingRank::class)->findBy(['idRanks' => $request->request->get('id')]);
        foreach ($ClassTrapping as $ct) {
            $result[] = [
                'id' => $ct->getId(),
                'type' => $ct->getType(),
                'tID' => $ct->getIdTrapping(),
                'qte' => $ct->getQte()
            ];
        }

        return new Response($this->renderView('ranks/tableRanksTrapping.html.twig',[
            'trappings' => $result,
            'listT' => $listT,
            'listBC' => $listBC,
            'listA' => $listA
        ]));
    }

    #[Route('/admin/deleteRankTrapping', name : 'deleteRankTrapping', methods : ['POST'])]
    public function deleteRankTrapping(ManagerRegistry $doctrine, Request $request){
        $ct = $doctrine->getRepository(TrappingRank::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($ct);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }

    #[Route('/admin/saveRankTrapping', name : 'saveRankTrapping', methods : ['POST'])]
    public function saveRankTrapping(ManagerRegistry $doctrine, Request $request){
        $entityManager = $doctrine->getManager();
        $data = json_decode($request->request->get('data'),true);
        
        foreach ($data as $d) {
            if($d['id'] >= 0){
                $ct = $doctrine->getRepository(TrappingRank::class)->find($d['id']);
            }else{
                $ct = new TrappingRank();
            }
            $ct->setIdRanks($request->request->get('id'));
            $ct->setIdTrapping($d['idT']);
            $ct->setType($d['type']);
            $ct->setQte($d['qte']);
            $entityManager->persist($ct);
        }

        $entityManager->flush();
        return new JSONResponse(['result' => "OK"]);
    }
}
