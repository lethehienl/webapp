<?php

namespace PaymentBundle\Command;

use AppBundle\Utils\ServiceUtil;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestStripeCommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
      ->setName('stripe:test-charge')
      ->setDescription('Test charge Stripe')
      ->setHelp('This command is used to test Stripe payment');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Start to check test from Stripe ...');

    $cardData = [
     'exp_month' => '12', 'exp_year' => '2021', 'number' => '4111111111111111', 'cvc' => '123'
    ];

    $stripeService = $this->getContainer()->get(ServiceUtil::STRIPE_SERVICE);
    $user = $this->getContainer()->get(ServiceUtil::USER_SERVICE)->findUserById(1);
    $amountData = ['amount' => 100, 'currency' => 'usd'];
    $this->getContainer()->get(ServiceUtil::PAYMENT_METHOD_SERVICE)->registerPaymentMethod($user, $cardData);
    $stripe = $stripeService->pay($user, $cardData, $amountData);

    $output->writeln('End to check test from Stripe ...');
  }
}