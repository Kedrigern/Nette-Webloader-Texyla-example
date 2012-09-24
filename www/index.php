<?php

$params = array();

// absolute filesystem path to this web root
$params['wwwDir'] = __DIR__;

// absolute filesystem path to the application root
$params['appDir'] = realpath(__DIR__ . '/../app');

// absolute filesystem path to this web root
define('WWW_DIR', __DIR__);

// absolute filesystem path to the application root
define('APP_DIR', WWW_DIR . '/../app');

// absolute filesystem path to the libraries
define('LIBS_DIR', WWW_DIR . '/../libs');

// uncomment this line if you must temporarily take down your site for maintenance
// require $params['appDir'] . '/templates/maintenance.phtml';

// load bootstrap file
require $params['appDir'] . '/bootstrap.php';
