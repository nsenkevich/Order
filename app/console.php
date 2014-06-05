<?php

// set to run indefinitely if needed
set_time_limit(0);

/* Optional. It’s better to do it in the php.ini file */
date_default_timezone_set('America/Los_Angeles'); 

// include the composer autoloader
require_once __DIR__ . '/../vendor/autoload.php'; 

require_once __DIR__ . '/../src/Order/Util/XmlElement.php'; 
require_once __DIR__ . '/../src/Order/Entities/Category.php';  
require_once __DIR__ . '/../src/Order/Entities/Product.php';
require_once __DIR__ . '/../src/Order/Entities/Order.php';
require_once __DIR__ . '/../src/Order/Entities/OrderFactory.php';
require_once __DIR__ . '/../src/Order/Services/OrderCalculator.php';
require_once __DIR__ . '/../src/Order/Commands/Calculator.php';

// import the Symfony Console Application 
use Symfony\Component\Console\Application; 
use Order\Commands\Calculator;
use Order\Services\OrderCalculator;

$app = new Application();
$app->add(new Calculator(new OrderCalculator()));
$app->run();