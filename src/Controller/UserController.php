<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\UserType;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/admin/editUser', name: 'editUser')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('User/index.html.twig');
    }
    
    #[Route('/admin/readAllUsers', name: 'readAllUsers', methods : ['POST'])]
    public function readAllUsers(ManagerRegistry $doctrine){
        $User = $doctrine->getRepository(User::class)->findAll();
        $result = [];
        foreach ($User as $u) {
            $result[] = [
                'id' => $u->getId(),
                'name' => $u->getUsername(),
                'role' => $u->getRoles()[0],
            ];
        }
        
        return new Response($this->renderView('User/tableUsers.html.twig',['Users' => $result]));
    }
    
    #[Route('/admin/createUsers', name: 'createUsers', methods : ['POST'])]
    public function createUser(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher) {
        if($request->isXmlHttpRequest()){
            $User = new User();
            $User->setUsername($request->request->get('name'));
            $User->setRoles([$request->request->get('roles')]);
            $User->setPassword($passwordHasher->hashPassword($User,$request->request->get('pwd')));
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($User);
            $entityManager->flush();
            return new JSONResponse(['result' => $request]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/readUsers', name : 'readUsers', methods : ['POST'])]
    public function readUser(ManagerRegistry $doctrine, Request $request){
        $id = $request->request->get('id');
        if($id != ''){
            $User = $doctrine->getRepository(User::class)->find($id);
        }else{
            $User = new User();
        }
        
        return $this->renderForm('form.html.twig', [
            'form' => $this->createForm(UserType::class, $User)
        ]);
    }
    
    #[Route('/admin/updateUsers', name: 'updateUsers', methods : ['POST'])]
    public function updateUser(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher){
        if($request->isXmlHttpRequest()){
            $User = $doctrine->getRepository(User::class)->find($request->request->get('id'));
            $User->setUsername($request->request->get('name'));
            $User->setRoles([$request->request->get('roles')]);
            $User->setPassword($passwordHasher->hashPassword($User,$request->request->get('pwd')));

            $entityManager = $doctrine->getManager();
            $entityManager->persist($User);
            $entityManager->flush();
            return new JSONResponse(['result' => $this->getUser()]);
        }
        return new JSONResponse(['result' => "ERROR"]);
    }
    
    #[Route('/admin/deleteUsers', name: 'deleteUsers', methods : ['POST'])]
    public function deleteUser(ManagerRegistry $doctrine, Request $request){
        $User = $doctrine->getRepository(User::class)->find($request->request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($User);
        $entityManager->flush(); 
        return new JSONResponse(['result' => "OK"]);
    }
}
