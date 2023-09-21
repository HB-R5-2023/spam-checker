<?php

namespace App\Controller;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpamController extends AbstractController
{
  private const SPAM_DOMAINS = ["test.com", "mailinator.com", "youpi.net"];

  #[Route('/api/check', name: 'app_spam_check', methods: "POST")]
  public function check(Request $request): JsonResponse
  {
    $data = $request->toArray();
    $email = $data['email'];

    $validator = new EmailValidator();

    if (!$validator->isValid($email, new RFCValidation())) {
      return $this->json(
        ["error" => "Email au format incorrect"],
        Response::HTTP_BAD_REQUEST
      );
    }

    $emailParts = explode("@", $email);

    if (in_array($emailParts[1], self::SPAM_DOMAINS)) {
      return $this->json(['result' => 'spam']);
    }

    return $this->json(['result' => 'ok']);
  }
}
