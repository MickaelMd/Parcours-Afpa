<?php

namespace App\Controller;

use App\Entity\BaseSymfony;
use App\Repository\BaseSymfonyRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route("/", name: "home")]
    public function index(Request $request, BaseSymfonyRepository $repository): Response {
        
      
        $items = $repository->findAll();
// dd($items[1]);


        
        return $this->render('home/index.html.twig', [
            'items' => $items
        ]);
    }



    // #[Route('/', name: "home" )]
    // public function edit()

}