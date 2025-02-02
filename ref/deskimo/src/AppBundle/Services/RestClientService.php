<?php

namespace AppBundle\Services;

use GuzzleHttp\Client;

class RestClientService
{
  protected $client;

  /**
   * RestClientService constructor.
   * @param $client
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }
}