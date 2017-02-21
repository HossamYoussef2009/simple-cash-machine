<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
$app = new Application();

$app['debug'] = true;

//  services
$app['cash-withdraw'] = function($app) {
    return new CashMachine\Controllers\CashWithdraw($app);
};

$app->register(new ServiceControllerServiceProvider());

//  routes
$app->get('/', function(){
    return "Hello, Simple Cash Machine service";
});

$app->get('/cash-withdraw/{amount}', 'cash-withdraw:createTransaction')
    ->value('amount', null);

return $app;
