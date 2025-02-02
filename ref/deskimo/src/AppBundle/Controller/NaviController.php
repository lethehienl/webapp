<?php

namespace AppBundle\Controller;

use ApiBundle\Services\ApiService;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class NaviController extends Controller
{
  private $breadcrumbs = [];
  private $renderData = [];

  public function responseJson($data)
  {
    return new JsonResponse($data);
  }

  public function showMessage(Request $request, $message, $level = 'success') //level: success, error
  {
    $session = $request->getSession();
    $session->getFlashBag()->add($level, $message);
  }

  public function writeLog($message, $level = 'err')
  {
    $this->get(ServiceUtil::LOGGER_SERVICE)->$level(__FUNCTION__ . ' ' . $message);
  }

  public function getDefaultData4DataTable()
  {
    return MessageUtil::defaultDataTableMessage();
  }

  public function getDefaultData4Chart()
  {
    return MessageUtil::defaultChartMessage();
  }

  public function validateXmlHttpRequest(Request $request)
  {
    if (!$request->isXmlHttpRequest()) {
      throw new AccessDeniedHttpException();
    }
  }

  public function addBreadCrumb(array $breadcrumbs)
  {
    if (empty($breadcrumbs)) {
      return;
    }

    foreach ($breadcrumbs as $key => $value) {
      $this->breadcrumbs[$key] = $value;
    }
  }

  public function renderTemplate($template, $data = null)
  {
    if (!empty($data)) {
      foreach ($data as $key => $value) {
        $this->renderData[$key] = $value;
      }
    }

    $this->renderData['breadcrumbs'] = $this->breadcrumbs;
    return $this->render($template, $this->renderData);
  }

  public function parseBodyRequest(Request $request, $asArray = true)
  {
    $data = $request->getContent();

    if (empty($data)) {
      throw new \Exception('Data is invalid', 1000);
    }

    try {
      return json_decode($data, $asArray);
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . '-' . $ex->getMessage());
      throw new \Exception('Data is invalid', 1000);
    }
  }

  public function handleAjaxRequest($serviceName, $func, $argument = null)
  {
    try {
      $service = $this->get($serviceName);

      if (!empty($argument)) {
        $data = $service->$func($argument);
      } else {
        $data = $service->$func();
      }

      if (!empty($data)) {
        $response = MessageUtil::formatMessage($data, 200, 'Success');
      } else {
        $response = MessageUtil::formatMessage();
      }

      return $this->json($response);
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . '|' . $ex->getMessage());
      $response = MessageUtil::formatMessage(null, 1000, $ex->getMessage());
      return $this->json($response);
    }
  }
}
