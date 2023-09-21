<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpamController extends AbstractController
{
  #[Route('/api/check', name: 'app_spam_check')]
  public function index(): Response
  {
    return $this->render('spam/index.html.twig', [
      'controller_name' => 'SpamController',
    ]);
  }
}
