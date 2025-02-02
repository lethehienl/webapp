<?php
namespace VisitBundle\Controller\BackOffice;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use VisitBundle\Services\VisitService;

class VisitController extends AdminController
{
  /**
   * @Route("admin/visit/manual-checkin", name="admin_visit_manual_checkin")
   * @Method("POST")
   */
  public function manualCheckinAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var VisitService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_SERVICE);
      $token = $visitService->parseBodyRequestData()->form_token;
      $validToken = $this->isCsrfTokenValid($this->getUser()->getUsername(), $token);

      if (!$validToken) {
        throw new AccessDeniedHttpException();
      }

      $visitService->manualCheckin();
      $data = MessageUtil::formatMessage();
    } catch(\Exception $ex) {
      $data = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($data);
  }

  /**
   * @Route("admin/visit/{id}/manual-checkout", name="admin_visit_manual_checkout_route")
   * @Method("POST")
   */
  public function manualCheckoutAction(Request $request, $id)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var VisitService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_SERVICE);
      $visitService->manualCheckout($id);
      $data = MessageUtil::formatMessage();
    } catch(\Exception $ex) {
      $data = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($data);
  }
}