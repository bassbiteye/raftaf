<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use app\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api")
 */
class SecuriteController extends AbstractController
{
    /**
     * @Route("/securite", name="securite")
     */
    public function index()
    {
        return $this->render('securite/index.html.twig', [
            'controller_name' => 'SecuriteController',
        ]);
    }

     /**
     * @Route("/admin")
     */
    // public function admin ()
    // {
    //     return new Response ( '<html><body>Admin page!</body></html>' );
    // }
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(isset($values->telephone,$values->password)) {
            $utilisateur = new Utilisateur();
            
            $utilisateur->setTelephone($values->telephone);
            $utilisateur->setNomUtilisateur($values->nomUtilisateur);
            $utilisateur->setPrenomUtilisateur($values->prenomUtilisateur);
            $utilisateur->setEtatUtilisateur($values->etatUtilisateur);
            $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur, $values->password));
            $utilisateur->setRoles(['ROLE_ADMIN']);
            $errors = $validator->validate($utilisateur);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }
 /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'telephone' => $user->getTelephone(),
            'roles' => $user->getRoles()
        ]);
    }

}
