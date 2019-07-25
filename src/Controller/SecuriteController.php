<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function admin ()
    {
        return new Response ( '<html><body>Admin page!</body></html>' );
    }
}
