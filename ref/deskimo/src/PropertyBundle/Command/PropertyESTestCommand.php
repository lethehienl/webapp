<?php
namespace PropertyBundle\Command;

use AppBundle\Utils\ServiceUtil;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PropertyESTestCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('property:test');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to test ...');

    $search = $this->getContainer()->get(ServiceUtil::SEARCH_SERVICE);
    $payload = [
//      'keyword' => 'building',
//      'is_open' => 1,
//      'country_code' => 65,
//      'lat' => 10.7486748,
//      'lng' => 106.6656986,
//      'distance' => '20km'
    ];
    $result = $search->searchProperty($payload);
    dump($result);die;

    $output->writeln('End to test ...');
  }
}