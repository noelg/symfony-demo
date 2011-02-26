<?php

require_once __DIR__.'/../cart/bootstrap.php';
require_once __DIR__.'/../cart/CartKernel.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new CartKernel('prod', false);
$kernel->handle(Request::createFromGlobals())->send();
