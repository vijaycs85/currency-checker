<?php

namespace CurrencyChecker;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Guzzle\Service\Loader\JsonLoader;
use GuzzleHttp\Command\Guzzle\Description;
use Symfony\Component\Config\FileLocator;

class CurrencyCheckerController {

  protected $client;

  public function __construct() {
    $locator = new FileLocator(array(__DIR__ . '/ServiceDescription'));
    $jsonLoader = new JsonLoader($locator);
    $description = $jsonLoader->load($locator->locate('services.json'));

    $headers = [
      'X-Mashape-Key' => 'dwOm8WpRxamshUJeTSKCuZJ9lWLkp1JPxzijsnejSHNGN7sz25',
      'Accept' => 'text/plain'
    ];
    $httpClient = new Client(['defaults' => ['headers' => $headers]]);
    $this->client = new GuzzleClient($httpClient,  new Description($description));
  }

  public function getPrice($from = 'GBP', $to = 'INR', $q = 1) {
     $result = $this->client->list(['from' => $from, 'q' => $q, 'to' => $to]);
    // $command = $this->client->getCommand('list', ['userId' => 1]);
    // $result = $this->client->execute($command);
    print implode(" ", array($q, $from, " = ", $result['conversion'], $to));
  }

}