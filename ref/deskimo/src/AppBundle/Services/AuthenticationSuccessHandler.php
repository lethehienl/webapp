<?php

namespace AppBundle\Services;

use LearningAwsBundle\Services\AwsService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use UserBundle\Services\UserService;
use UserBundle\Utils\RolesUtil;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
  private $router;

  private $userService;

  /**
   * AuthenticationSuccessHandler constructor.
   * @param $router
   */
  public function __construct(RouterInterface $router, UserService $userService)
  {
    $this->router = $router;
    $this->userService = $userService;
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token)
  {
    $roles = $token->getRoles();
    $targetPath = $this->userService->getRedirectPathByRole($roles);
    $url = $this->router->generate($targetPath);

    return new RedirectResponse($url);
  }
}
