<?php

namespace App\Bundle\UserBundle\Controller\Api;

use App\Bundle\AppBundle\Utils\ServiceUtil;
use App\Bundle\UserBundle\Entity\User;
use App\Bundle\UserBundle\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

//use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class UserController extends AbstractController
{
    private $jwtManager;
    private $authenticationManager;

    private $userService;

    public function __construct(JWTTokenManagerInterface  $jwtManager, UserAuthenticatorInterface $authenticationManager, UserService $userService)
    {
        $this->jwtManager = $jwtManager;
        $this->authenticationManager = $authenticationManager;
        $this->userService = $userService;
    }
    public function login(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['email']) || empty($data['password'])) {
            return new JsonResponse(['error' => 'Invalid credentials.'], 400);
        }

        // Fetching user by email

        $user = $this->userService->getRepository(User::class)->findOneByEmail($data['email']);

        if (!$user) {
            return new JsonResponse(['error' => 'Invalid credentials.'], 400);
        }

        // Check password
        if (!password_verify($data['password'], $user->getPassword())) {
            return new JsonResponse(['error' => 'Invalid credentials.'], 400);
        }

        // Create token
        $token = $this->jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }

    public function register(
      Request $request,
      EntityManagerInterface $entityManager,
      UserPasswordHasherInterface $passwordHasher,
      ValidatorInterface $validator
    ): JsonResponse{
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'], $data['username'], $data['password'])) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setStatus(1);

        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }


        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User registered successfully'], 201);
    }

}