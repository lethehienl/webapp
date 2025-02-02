<?php

    namespace App\Bundle\UserBundle\Controller\User;

    use ApiPlatform\Validator\ValidatorInterface;
    use AppBundle\Utils\ServiceUtil;
    use Doctrine\ORM\EntityManagerInterface;
    use NotificationBundle\Util\NotificationUtil;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use UserBundle\Services\UserService;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use UserBundle\Form\User\ForgotPasswordType;
    use UserBundle\Form\User\ResetPasswordType;
    use UserBundle\Entity\User;
    use UserBundle\Utils\LandingPageUtil;

    class UserController extends AbstractController
    {

        public function login(): Response
        {
            echo 'Anonymous > Login';die;
            throw new \LogicException('This method can be blank - it will be intercepted by the "json_login" authenticator.');
        }


        public function register(
          Request $request,
          EntityManagerInterface $entityManager,
          UserPasswordHasherInterface $passwordHasher,
          ValidatorInterface $validator
        ): JsonResponse {
            $data = json_decode($request->getContent(), true);

            if (!isset($data['email'], $data['username'], $data['password'])) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }

            $user = new User();
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            $user->setStatus(1);

            // Mã hóa mật khẩu
            $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            // Validate dữ liệu
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

