<?php

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestNotificationCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('notification:test')
      ->setDescription('Test notification by type')
      ->addArgument('type', InputArgument::REQUIRED, 'Please choose type of notification to test! email | sms | push_notification')
      ->setHelp('This command is used to test notification');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to test notification ...');

    $type = $input->getArgument('type');
    switch ($type) {
      case 'email':
        $this->getContainer()->get('email_notification.service')
          ->setTo('qmtri091991@gmail.com')
          ->setTemplate('test')
          ->setLanguage('vi')
          ->setSubject('test ne')
          ->setBody([
            'title' => 'aaaa',
            'label' => 'bbbb'
          ])
          ->send();
        break;
      case 'sms':
        $this->getContainer()->get('sms_notification.service')
          ->setTo('+84355527245')
          ->setLanguage('vi')
          ->setBody('test message')
          ->send();
        break;
    }


    $output->writeln('End to test notification ...');
  }
}