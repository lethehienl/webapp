<?php


namespace App\Bundle\AppBundle\Controller;

use App\Bundle\AppBundle\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    private MailerService $mailer;

    public function __construct(MailerService $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendEmail(Request $request): JsonResponse
    {

        $email = $request->query->get('email');
        if (!$email) {
            return $this->json(['message' => 'Email is required'], 400);
        }

        $subject = "Test Email from Symfony";
        $content = "<p>Xin chào, đây là email test từ Symfony Mailer!</p>";

        $this->mailer->sendEmail($email, $subject, $content);

        return $this->json(['message' => 'Email sent successfully']);
    }
}