<?php

namespace App\Controller;
use App\Entity\Partenaire;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Form\PartenaireType;
use App\Entity\Utilisateur;

/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
   /**
     * @Route("/ajoutP", name="ajoutP", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        // $partenaire = new Partenaire();
        // $form=$this->createForm(PartenaireType::class,$partenaire);
        // $data=json_decode($request->getContent(),true);
        
   
        // $form->submit($data);
        
        // if($form->isSubmitted() && $form->isValid()){
           
            // $em=$this->getDoctrine()->getManager();
            // $em->persist($partenaire);
            // $em->flush();
            // $data = [
            //           'status' => 201,
            //               'message' => 'Le partenaire a bien été ajouté'
            //            ];
            //        return new JsonResponse($data, 201);
            //return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));
        //}
        //return $this->handleView($this->view($form->getErrors()));
        // $data = [
        //     'status' => 400,
        //         'message' => 'erreur'
        //      ];
        //  return new JsonResponse($data, 400);
        
        //$data=json_decode($request->getContent(),true);
        //$partenaire = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $partenaire = new Partenaire();
        $dataa = json_decode($request->getContent(), true);
    
        $partenaire->setRaisonSociale($dataa['raisonSociale']);
        $partenaire->setNinea($dataa['ninea']);
        $partenaire->setNumCompte($dataa['numCompte']);
        $partenaire->setSolde($dataa['solde']);
        //$partenaire->setCreatedBy($dataa['createdBy']);
        $partenaire->setAdressePartenaire($dataa['adressePartenaire']);
        $user = $entityManager->getRepository(Utilisateur::class)->findBy(array('id' => $dataa['createdBy']));
        var_dump($user);

        //$partenaire->setCreatedBy($user);

         $entityManager->persist($partenaire);
         $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Le téléphone a bien été ajouté'
        ];
        return new JsonResponse($data, 201);
    }
 /**
     * @Route("/bloquer/{id}", name="bloquer", methods={"PUT"})
     */
    public function update(Request $request, SerializerInterface $serializer, Partenaire $partenaire, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $bloquer = $entityManager->getRepository(Partenaire::class)->find($partenaire->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $value){
            if($key && !empty($value)) {
                $adressePartenaire = ucfirst($key);
                $setter = $adressePartenaire;
                $bloquer->$setter($value);
            }
        }
        $errors = $validator->validate($bloquer);
        if(count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Le compte a bien été mis à jour'
        ];
        return new JsonResponse($data);
}
}