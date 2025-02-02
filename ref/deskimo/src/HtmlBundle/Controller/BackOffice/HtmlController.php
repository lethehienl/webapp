<?php
namespace HtmlBundle\Controller\BackOffice;

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

class HtmlController extends Controller
{
  /**
   * @Route("/property/detail", name="html_admin_property_detail_route")
   * @Method("GET")
   */
  public function propertyDetailAction(Request $request)
  {
    return $this->render('@Html/admin/property/detail.html.twig');
  }

}
