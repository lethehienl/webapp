<?php

namespace App\Bundle\UserBundle\Controller\User;

use App\Bundle\AppBundle\Utils\StatusUtil;
use App\Bundle\UserBundle\Form\RegistrationFormType;
use AppBundle\Utils\ServiceUtil;
use Doctrine\ORM\EntityManagerInterface;
use NotificationBundle\Util\NotificationUtil;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\FormFactoryInterface;

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
}

