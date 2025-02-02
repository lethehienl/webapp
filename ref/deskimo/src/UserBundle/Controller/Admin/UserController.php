<?php

namespace UserBundle\Controller\Admin;

use AppBundle\Controller\NaviController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\User\UserType;
use UserBundle\Services\UserService;
use UserBundle\Utils\PermissionUtil;
use UserBundle\Utils\RolesUtil;

class UserController extends NaviController
{
  private function buildTabs3User()
  {
    $tabs = [
      $this->generateUrl('admin_users_route') => 'All users',
      $this->generateUrl('admin_individual_users_route') => 'Individual',
      $this->generateUrl('admin_role_permission_route') => 'Role & permission',
    ];

    return $tabs;
  }

  /**
   * @Route("/users/individual", name="admin_individual_users_route")
   * @Method({"GET"})
   */
  public function individualUserAction()
  {
    $this->denyAccessUnlessGranted(RolesUtil::ROLE_DESKIMO_ADMIN);
    $this->addBreadCrumb($this->buildTabs3User());

    return $this->renderTemplate('UserBundle:admin:user/user-list.html.twig');
  }

  /**
   * @Route("/users", name="admin_users_route")
   * @Method({"GET"})
   */
  public function indexAction()
  {
    $this->denyAccessUnlessGranted(RolesUtil::ROLE_DESKIMO_ADMIN);
    $this->addBreadCrumb($this->buildTabs3User());

    return $this->renderTemplate('UserBundle:admin:user/user-list.html.twig');
  }

  /**
   * @Route("/users/search", name="admin_users_search_route")
   * @Method({"GET"})
   */
  public function searchUserAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);
    $this->denyAccessUnlessGranted(PermissionUtil::LIST_USER_ADMIN);

    try {
      /** @var UserService $userService */
      $userService = $this->get(ServiceUtil::USER_SERVICE);
      $data = $userService->getUsers();
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $data = $this->getDefaultData4DataTable();
    }

    return $this->responseJson($data);
  }

  /**
   * @Route("/users/role-permission", name="admin_role_permission_route")
   * @Method({"GET", "POST"})
   */
  public function showRolePermissionAction(Request $request)
  {
    $this->denyAccessUnlessGranted(RolesUtil::ROLE_DESKIMO_ADMIN);
    $roles = RolesUtil::CAN_ASSIGN_PERMISSION_ROLE_MAPPING;
    $permissions = PermissionUtil::PERMISSION_MAP;

    /** @var UserService $userService */
    $userService = $this->get(ServiceUtil::USER_SERVICE);

    if ($request->getMethod() == $request::METHOD_POST) {
      try {
        $data = $request->request->all();
        $userService->extractAndAssignPermission($data['permission']);

        $message = 'Update permission successfully!';
        $this->showMessage($request, $message);
      } catch (\Exception $ex) {
        $message = MessageUtil::getBusinessMessage($ex);
        $this->showMessage($request, $message, 'error');
      }
    }

    $this->addBreadCrumb($this->buildTabs3User());

    $currentRolePermissions = $userService->getCurrentAssignedPermission();
    $data = ['roles' => $roles, 'permissions' => $permissions, 'role_permissions' => $currentRolePermissions];

    return $this->renderTemplate('UserBundle:admin/user:permission-list.html.twig', $data);
  }

  /**
   * @Route("/users/create", name="admin_user_create_route")
   * @Method({"GET", "POST"})
   */
  public function createUserAction(Request $request)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::CREATE_USER_ADMIN);

    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      try {
        /** @var UserService $userService */
        $userService = $this->get(ServiceUtil::USER_SERVICE);
        $userService->createOrUpdateUser($user);

        $message = $user->getUsername() . ' is created successfully!';
        $this->showMessage($request, $message);

        return $this->redirectToRoute('admin_users_route');
      } catch (\Exception $ex) {
        $this->writeLog($ex->getMessage());
        $message = MessageUtil::getBusinessMessage($ex);
        $this->showMessage($request, $message, 'error');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Create user',
    );

    return $this->renderTemplate('@User/admin/user/user-form.html.twig', $data);
  }

  /**
   * @Route("/users/edit/{id}", name="admin_user_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editUserAction(Request $request, $id)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::EDIT_USER_ADMIN);

    /** @var UserService $userService */
    $userService = $this->get(ServiceUtil::USER_SERVICE);

    /** @var User $user */
    $user = $userService->findUserById($id);
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      try {
        $userService->createOrUpdateUser($user);
        $message = $user->getUsername() . ' is edited successfully!';
        $this->showMessage($request, $message);

        return $this->redirectToRoute('admin_users_route');
      } catch (\Exception $ex) {
        $this->writeLog($ex->getMessage());
        $message = MessageUtil::getBusinessMessage($ex);
        $this->showMessage($request, $message, 'error');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Edit user',
    );

    return $this->renderTemplate('@User/admin/user/user-form.html.twig', $data);
  }
}
