<?php
namespace InvoiceBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StatusUtil;
use InvoiceBundle\Entity\Invoice;
use InvoiceBundle\Form\InvoiceType;
use InvoiceBundle\Services\InvoiceService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserBundle\Utils\PermissionUtil;

class InvoiceController extends Controller
{
  /**
   * @Route("/invoice", name="invoice_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    //$this->denyAccessUnlessGranted(PermissionUtil::VIEW_INVOICE);


    return $this->render('@Invoice/invoice/index.html.twig', [
      //'invite_form' => $form->createView()
    ]);
  }

  /**
   * @Route("/invoice/search", name="invoice_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
   // $this->denyAccessUnlessGranted(PermissionUtil::VIEW_INVOICE);
    /*if (!$request->isXmlHttpRequest()) {
      throw new AccessDeniedException();
    }*/

    try {
      /** @var InvoiceService $invoiceService */
      $invoiceService = $this->get(ServiceUtil::INVOICE_SERVICE);
      $data = $invoiceService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/invoice/create", name="invoice_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    //$this->denyAccessUnlessGranted(PermissionUtil::ADD_INVOICE);
    $invoice = new Invoice();
    $form = $this->createForm(InvoiceType::class, $invoice);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var InvoiceService $invoiceService */
        $invoiceService = $this->get(ServiceUtil::INVOICE_SERVICE);
        $invoiceService->create($invoice);
        $message = 'The "' . $invoice->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('invoice_management_route');
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Invoice: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add amenity fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Invoice',
    );

    return $this->render('@Invoice/invoice/new.html.twig', $data);
  }

  /**
   * @Route("/invoice/{id}/delete", name="invoice_management_delete_route")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    //$this->denyAccessUnlessGranted(PermissionUtil::DELETE_INVOICE);
    try {
      /** @var InvoiceService $invoiceService */
      $invoiceService = $this->container->get(ServiceUtil::INVOICE_SERVICE);
      /** @var Invoice $invoice */
      $invoice = $invoiceService->getDetail($id);
      if (isset($invoice)) {

        if ($invoiceService->delete($invoice)) {
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
   * @Route("/invoice/{id}/update", name="invoice_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {
    //$this->denyAccessUnlessGranted(PermissionUtil::EDIT_INVOICE);
    $session = $request->getSession();

    try {
      /** @var InvoiceService $invoiceService */
      $invoiceService = $this->container->get(ServiceUtil::INVOICE_SERVICE);

      /** @var Invoice $invoice */
      $invoice = $invoiceService->getDetail($id);

      if (isset($invoice)) {

        /*$currentUser = $this->getUser();*/

        $form = $this->createForm(InvoiceType::class, $invoice);
        /* $form->add('imageTmp')->add('imageTmp', FileType::class, array(
           'label' => 'Image',
           'required' => false,
         ));*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $invoiceService->update($invoice);
          $message = 'The "' . $invoice->getInvoiceNo() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('invoice_management_route');
        }

        return $this->render('@Invoice/invoice/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Invoice',
        ));
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('invoice_management_route');
    }
  }

}
