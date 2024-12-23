<?php

    namespace App\Bundle\UserBundle\Controller\Anonymous;

    use AppBundle\Utils\ServiceUtil;
    use NotificationBundle\Util\NotificationUtil;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use UserBundle\Services\UserService;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use UserBundle\Form\User\ForgotPasswordType;
    use UserBundle\Form\User\ResetPasswordType;
    use UserBundle\Entity\User;
    use UserBundle\Utils\LandingPageUtil;

    class SecurityController extends AbstractController
    {

        public function loginCheck(): Response
        {
            echo 'api/user/login';die;

        }

        /**
         * @Route("/", name="anonymous_route")
         */
        public function indexAction()
        {
            return $this->redirectToRoute('admin_dashboard_route');
        }

        /**
         * @Route("/login", name="user_login_route")
         */
        public function loginAction()
        {
            $authenticationUtils = $this->get('security.authentication_utils');
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            $user = $this->getUser();

            if (!$user) {
                if ($error) {
                    $this->addFlash('error', 'Username or password is invalid!');
                }

                return $this->render('@User/anonymous/login.html.twig', [
                  'last_username' => $lastUsername
                ]);
            }

            $roles = $user->getRoles();
            $targetPath = $this->get('user.service')->getRedirectPathByRole($roles);
            return $this->redirectToRoute($targetPath);
        }

        /**
         * @Route("/logout", name="user_logout_route")
         */
        public function logoutAction()
        {
            throw new \RuntimeException('This should never be called directly.');
        }

        /**
         * @Route("/forgot-password", name="forgot_password_route", methods={"GET|POST"})
         */
        public function forgotPasswordAction(Request $request)
        {
            $userEntity = new User();
            $form = $this->createForm(ForgotPasswordType::class, $userEntity);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $username = $form['username']->getData();

                if (!$username) {
                    $this->addFlash('error', 'User email can not null');
                    return $this->redirectToRoute('forgot_password_route');
                }

                try {
                    /** @var UserService $userService */
                    $userService = $this->get(ServiceUtil::USER_SERVICE);
                    $userService->forgotPassword($username);
                    $this->addFlash('success', 'Email sent! Please check your inbox.');
                } catch (\Exception $e) {
                    $this->writeLog(__FUNCTION__ . '|' . $e->getMessage());
                    $this->addFlash('error', 'Something went wrong, please contact Admin Deskimo.');
                    return $this->redirectToRoute('forgot_password_route');
                }

                return $this->redirectToRoute('user_login_route');
            }

            return $this->render('@User/anonymous/forgotPassword.html.twig', ['form' => $form->createView()]);
        }

        /**
         * @Route("/reset-password/{token}", name="reset_password_route", methods={"GET|POST"})
         */
        public function resetPassword(Request $request)
        {
            $userInfo = ['plainPassword' => null];
            $form = $this->createForm(ResetPasswordType::class, $userInfo);
            $form->handleRequest($request);
            $token = $request->get('token');

            if (!$token) {
                $this->addFlash('error', 'Missing token');

                return $this->redirect($this->generateUrl('user_login_route'));
            }

            /** @var \UserBundle\Entity\User $user */
            $user = $this->userRepository()->findOneBy(['hashToken' => $token]);

            if ($user === null) {
                $this->addFlash('Error', 'Wrong token.');
                return $this->redirectToRoute('user_login_route');
            }

            $hashExpireDate = $user->getExpiredTokenAt();

            $validExpireDate = $this->checkTimeValid($hashExpireDate);

            if (!$validExpireDate) {
                $this->addFlash('error', 'Your request reset password expired!');

                return $this->redirectToRoute('user_login_route');
            }

            if ($form->isSubmitted() && $form->isValid()) {

                $validExpireDate = $this->checkTimeValid($hashExpireDate);

                if (!$validExpireDate) {
                    $this->addFlash('error', 'Your request reset password expired!');

                    return $this->redirectToRoute('user_login_route');
                }

                try {
                    $formData = $form->getData();

                    /** @var UserService $userService */
                    $userService = $this->get(ServiceUtil::USER_SERVICE);
                    $userService->resetPassword($user, $formData);

                    return $this->redirectToRoute('user_login_route');

                } catch (\Exception $e) {
                    $this->writeLog(__FUNCTION__ . '|' . $e->getMessage());

                    return $this->redirectToRoute('user_login_route');
                }
            }

            return $this->render("UserBundle:anonymous:resetPassword.html.twig", ['form' => $form->createView()]);
        }

        /**
         * @Route("/contact-us", name="contact_us_route")
         */
        public function contactUsAction()
        {
            return $this->render('@User/anonymous/contactUs.html.twig');
        }
    }

