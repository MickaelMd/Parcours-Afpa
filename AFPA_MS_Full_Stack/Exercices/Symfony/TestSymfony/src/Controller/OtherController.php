<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OtherController extends AbstractController
{


    #[Route('/other/', name: 'other.index')]
    
    public function index(Request $request): Response
    {
       return $this->render('/home/index.html.twig');
    }


    #[Route('/other/{test}-{id}', name: 'other.show', requirements:['id' => '\d+', 'test' => '[a-z0-9-]+'])]
    
    public function indexid(Request $request, string $test, int $id): Response
    {
      return  dd($test, $id);
    }
}