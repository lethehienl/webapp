<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateOauthClientCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('oauth2:gen-client')
      ->setHelp('This command is used to generate client id');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to generate ...');

    $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
    $client = $clientManager->createClient();
    $client->setRedirectUris(array('https://deskimo.com'));
    $client->setAllowedGrantTypes(array('password', 'https://deskimo.com/grants/otp'));
    $clientManager->updateClient($client);

    $output->writeln('End to generate ...');
  }
}