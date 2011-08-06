<?php
/**
 * GUI for Acl bootstrap file.
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI for Acl
 */

// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';

// Step 2: Configure environment
// 2a) enable Nette\Debug for better exception and error visualisation
\Nette\Diagnostics\Debugger::enable();

// 2b) load configuration from config.ini file
\Nette\Environment::loadConfig(__DIR__."/config.neon");

\Nette\Environment::setProductionMode(\FALSE);
//Environment::setMode(Environment::PRODUCTION);


//Environment::getServiceLocator()->addService('Login', 'Nette\Security\IAuthenticator');
//Environment::getServiceLocator()->addService('Acl', 'Nette\Security\IAuthorizator');


// Step 3: Configure application
// 3a) get and setup a front controller
$application = \Nette\Environment::getApplication();
$application->errorPresenter = 'Error';
if (\Nette\Environment::isProduction()){
    $application->catchExceptions = TRUE;
}

// Step 4: Setup application router
$router = $application->getRouter();

$router[] = new \Nette\Application\Routers\Route('index.php', array(
	'module' => 'Front',
	'presenter' => 'Default',
	'action' => 'default',
), \Nette\Application\Routers\Route::ONE_WAY);

$router[] = new \Nette\Application\Routers\Route('<module>/<presenter>/<action>/<id>', array(
	'module' => 'Front',
	'presenter' => 'Default',
	'action' => 'default',
	'id' => NULL,
));

// Step 5: Run the application!
$application->run();
