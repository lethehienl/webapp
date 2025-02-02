<?php
namespace CompanyBundle\Controller\BackOffice;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StatusUtil;
use CompanyBundle\Entity\PropertyCompany;
use CompanyBundle\Form\PropertyCompanyAccountType;
use CompanyBundle\Form\PropertyCompanyType;
use CompanyBundle\Services\PropertyCompanyService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserBundle\Utils\PermissionUtil;

class PropertyCompanyController extends Controller
{

  /**
   * @Route("/company", name="property_company_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::VIEW_COMPANY_PROPERTY);
    $form = $this->createForm(PropertyCompanyAccountType::class);

    return $this->render('@Company/company/index.html.twig', [
      'invite_form' => $form->createView()
    ]);
  }

  /**
   * @Route("/company/search", name="property_company_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::VIEW_COMPANY_PROPERTY);
    /*if (!$request->isXmlHttpRequest()) {
      throw new AccessDeniedException();
    }*/

    try {
      /** @var PropertyCompanyService $propertyCompanyService */
      $propertyCompanyService = $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE);
      $data = $propertyCompanyService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/company/create", name="property_company_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::ADD_COMPANY_PROPERTY);
    $propertyCompany = new PropertyCompany();
    $form = $this->createForm(PropertyCompanyType::class, $propertyCompany);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var PropertyCompanyService $propertyCompanyService */
        $propertyCompanyService = $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE);
        $propertyCompanyService->create($propertyCompany);
        $message = 'The "' . $propertyCompany->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('property_company_management_route');
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Property Company: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add amenity fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Property Company',
    );

    return $this->render('@Company/company/new.html.twig', $data);
  }

  /**
   * @Route("/company/{id}/delete", name="property_company_management_delete_route")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::DELETE_COMPANY_PROPERTY);
    try {
      /** @var PropertyCompanyService $propertyCompanyService */
      $propertyCompanyService = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE);
      /** @var Property $property */
      $propertyCompany = $propertyCompanyService->getDetail($id);
      if (isset($propertyCompany)) {

        if ($propertyCompanyService->delete($propertyCompany)) {
          $response = MessageUtil::formatFoMessageAdmin(200, 'Success');
        }
      } else {
        $message = 'Not Authorize';
        $response = MessageUtil::formatFoMessageAdmin(400, $message);
      }
    } catch (\Exception $ex) {
      $message = 'Not Authorize';
      $response = MessageUtil::formatFoMessageAdmin($ex->getCode(), $message);
    }

    return new JsonResponse($response);
  }

  /**
   * @Route("/company/{id}/update", name="property_company_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::EDIT_COMPANY_PROPERTY);
    $session = $request->getSession();

    try {
      /** @var PropertyCompanyService $propertyCompanyService */
      $propertyCompanyService = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE);

      /** @var PropertyCompany $propertyCompany */
      $propertyCompany = $propertyCompanyService->getDetail($id);

      if (isset($propertyCompany)) {

        /*$currentUser = $this->getUser();*/

        $form = $this->createForm(PropertyCompanyType::class, $propertyCompany);
        /* $form->add('imageTmp')->add('imageTmp', FileType::class, array(
           'label' => 'Image',
           'required' => false,
         ));*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $propertyCompanyService->update($propertyCompany);
          $message = 'The "' . $propertyCompany->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_company_management_route');
        }

        return $this->render('@Company/company/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property Company',
        ));
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_company_management_route');
    }
  }

  /**
   * @Route("/company/invite", name="property_company_invite_account_route")
   * @Method("POST")
   */
  public function inviteCompanyAccountAction(Request $request)
  {
    $form = $this->createForm(PropertyCompanyAccountType::class);
    $form->handleRequest($request);
    $message = MessageUtil::formatMessage();

    try {
      if ($form->isSubmitted() && $form->isValid()) {
        $propertyCompanyService = $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE);
        $propertyCompanyService->inviteCompanyAccount($form->getData(), $form->get('company')->getData());
        return $this->json($message);
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::formatMessage(null, $ex->getCode(), $ex->getMessage());
      return $this->json($message);
    }

    $message = MessageUtil::formatMessage(null, MessageUtil::FAIL, $form->getErrors()->current()->getMessage());
    return $this->json($message);
  }

  /**
   * @Route("/company/current/{id}", name="property_company_change_current_route")
   * @Method("GET")
   */
  public function changeCurrentCompanyAction(Request $request, $id)
  {
    $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->changeCurrentCompany($id);
    return $this->redirectToRoute('admin_dashboard_route');
  }

  /**
   * @Route("/property/current/{id}", name="property_change_current_route")
   * @Method("GET")
   */
  public function changeCurrentPropertyAction(Request $request, $id)
  {
    try {
      $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->changeCurrentProperty($id);
    } catch (\Exception $ex) {

    }

    return $this->redirectToRoute('admin_dashboard_route');
  }

  /**
   * @Route("/property/status/{id}/{status}", name="property_change_status_route")
   * @Method("GET")
   */
  public function togglePropertyStatusAction(Request $request, $id, $status = StatusUtil::ACTIVE_CODE)
  {
    $this->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->changeCurrentPropertyStatus($id, $status);
    return $this->redirectToRoute('admin_dashboard_route');
  }
}
