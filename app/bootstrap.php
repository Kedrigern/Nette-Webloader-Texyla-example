<?php
use Nette\Application\Routers\Route;
// Load Nette Framework
//require LIBS_DIR . "/Nette/loader.php";
require LIBS_DIR . "/../vendor/autoload.php";

// Configure application
$configurator = new Nette\Config\Configurator;
// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode($configurator::AUTO);
$configurator->enableDebugger(__DIR__ . "/../log");
// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . "/../temp");
$configurator->createRobotLoader()
        ->addDirectory(APP_DIR)
        ->addDirectory(LIBS_DIR)
        ->register();

$webloaderExtension = new \WebLoader\Nette\Extension();
$webloaderExtension->install($configurator);

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . "/config/config.neon");
$container = $configurator->createContainer();

// Setup router
# Simple router if mod rewrite is not allowed
$container->router = new Nette\Application\Routers\SimpleRouter('Front:Homepage:default');

#$container->router[] = new Route("index.php", "front:Homepage:default", Route::ONE_WAY);
//$container->router[] = new Route("<presenter>/<action>[/<id>]", "Homepage:default");
#$container->router[] = new Route("<presenter>/<action>/<id>", array(
#        "module" => "Front",
#        "presenter" => "Homepage",
#        "action" => "default",
#        "id" => NULL,
#    ));

// Configure and run the application!
$container->application->run();
