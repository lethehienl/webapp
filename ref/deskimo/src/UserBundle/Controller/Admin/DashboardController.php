<?php

namespace UserBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends AdminController
{
  /**
   * @Route("", name="admin_dashboard_route")
   */
  public function indexAction()
  {
    $data = ['only_display_usage' => false];
    return $this->renderTemplate('UserBundle:admin:dashboard.html.twig', $data);
  }

  /**
   * @Route("/statistic/chart-revenue", name="admin_statistic_revenue_chart_route")
   */
  public function getChartRevenueAction()
  {
    $data = ['only_display_usage' => false];
    return $this->renderTemplate('UserBundle:admin:dashboard.html.twig', $data);
  }
}
