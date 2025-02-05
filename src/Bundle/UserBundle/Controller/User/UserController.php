<?php

namespace App\Bundle\UserBundle\Controller\User;

use App\Bundle\AppBundle\Services\MailerService;
use App\Bundle\AppBundle\Utils\StatusUtil;
use App\Bundle\UserBundle\Form\RegistrationFormType;
use AppBundle\Utils\ServiceUtil;
use Doctrine\ORM\EntityManagerInterface;
use NotificationBundle\Util\NotificationUtil;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserController extends AbstractController
{
    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_home_route');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@User/front_office/login.html.twig', [
          'last_username' => $lastUsername,
          'error' => $error,
        ]);
    }


    public function logout(): void
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }


    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher,): Response
    {

        $user = new User();
        $form = $this->formFactory->create(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $passwordHasher->hashPassword($user, $form->get('password')->getData());
            $user->setPassword($hashedPassword);
            $user->setStatus(StatusUtil::ACTIVE_CODE);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_login');
        }

        return $this->render('@User/front_office/register.html.twig', [
          'registrationForm' => $form->createView(),
        ]);
    }

    public function forgotPassword(Request $request, EntityManagerInterface $entityManager, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer): Response
    {

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);


            if ($user) {
                // Tạo token reset password
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                // Gửi email đặt lại mật khẩu
                $resetLink = $_SERVER['REQUEST_SCHEME'] . '://' .  $_SERVER['HTTP_HOST'] . $this->generateUrl('user_reset_password', ['token' => $token], true);

                $email = (new Email())
                  ->from(MailerService::MAIL_FORM)
                  ->to($user->getEmail())
                  ->subject('Reset your password')
                  ->text('Click the following link to reset your password: ' . $resetLink);
                $mailer->send($email);

                $this->addFlash('success', 'An email has been sent with a password reset link.');

                return $this->redirectToRoute('user_login');
            }

            $this->addFlash('danger', 'Email not found.');
        }

        return $this->render('@User/front_office/forgot_password.html.twig');
    }

    public function resetPassword(string $token, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('Invalid or expired token.');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('password');
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);
            $user->setResetToken(null); // Xóa token sau khi reset

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Your password has been reset successfully.');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('@User/front_office/reset_password.html.twig', ['token' => $token]);
    }
}

