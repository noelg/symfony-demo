<?php

require_once __DIR__.'/../cart/CartKernel.php';

$kernel = new CartKernel('prod', false);
$kernel->run();
