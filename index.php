<?php
require __DIR__ . '/vendor/autoload.php';

use CurrencyChecker\CurrencyCheckerController;

$client = new CurrencyCheckerController();

if (is_array($_GET)){
  $client->getPrice($_GET['from']?:NULL, $_GET['to']?:NULL, $_GET['q']?:NULL);
}
else {
  // Use default.
  $client->getPrice();
}

