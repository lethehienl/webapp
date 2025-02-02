<?php

namespace UserBundle\Command;


use AppBundle\Utils\ServiceUtil;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserBundle\Entity\User;
use UserBundle\Utils\RolesUtil;

class AddAdminCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('admin:add')
      ->setDescription('Add admin')
      ->setHelp('This command is used to add admin');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to add admin ...');
    $user = new User();
    $user->setUsername('admin@yopmail.com');
    $user->setPassword('123456');
    $user->setRoleId(RolesUtil::ROLE_DESKIMO_ADMIN_ID);
    $user->setStatus(1);
    $user->setPhoneNumber('84355527245');
    $this->getContainer()->get(ServiceUtil::USER_SERVICE)->createOrUpdateUser($user);

    $output->writeln('End to add admin ...');
  }
}