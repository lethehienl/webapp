<?php


namespace App\Bundle\AppBundle\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    CONST MAIL_FORM = 'lethehienl@gmail.com';
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        $email = (new Email())
          ->from(self::MAIL_FORM)
          ->to($to)
          ->subject($subject)
          ->html($content);

        $this->mailer->send($email);
    }
}