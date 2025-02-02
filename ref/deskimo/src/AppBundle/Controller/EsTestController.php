<?php


namespace AppBundle\Controller;

use Elastica\Client;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class EsTestController extends Controller
{

  public function __construct()
  {
  }
  public function indexAction(Request $request)
  {
    /** @var Client $esService */
    $esService = $this->get('fos_elastica.client.default');
    $testClient = $esService->getConnectionStrategy();
    echo '<pre>'; print_r($testClient); die;
  }
}
