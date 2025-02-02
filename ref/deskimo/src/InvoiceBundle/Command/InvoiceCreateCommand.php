<?php

namespace InvoiceBundle\Command;

use AppBundle\Utils\ServiceUtil;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InvoiceCreateCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('invoice:create')
      ->setDescription('Invoice Create')
      ->setHelp('This command is used to create invoice');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to invoice create ...');

    $stripeService = $this->getContainer()->get(ServiceUtil::INVOICE_SERVICE);
    //$user = $this->getContainer()->get(ServiceUtil::USER_SERVICE)->findUserById(1);
    //$amountData = ['amount' => 100, 'currency' => 'usd'];
    //$this->getContainer()->get(ServiceUtil::PAYMENT_METHOD_SERVICE)->registerPaymentMethod($user, $cardData);
    //$stripe = $stripeService->pay($user, $cardData, $amountData);

    $output->writeln('End to invoice create.');
  }
}