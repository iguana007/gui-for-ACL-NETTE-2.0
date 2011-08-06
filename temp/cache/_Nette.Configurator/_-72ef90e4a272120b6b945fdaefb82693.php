<?php //netteCache[01]000219a:2:{s:4:"time";s:21:"0.68037300 1312632473";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:49:"/opt/lampp/htdocs/gui-for-acl-1.0/app/config.neon";i:2;i:1312630698;}}}?><?php
// source file /opt/lampp/htdocs/gui-for-acl-1.0/app/config.neon

$container->addService('authenticator', 'Login');

$container->addService('robotLoader', function($container) {
	$service = call_user_func(
		array ( 0 => 'Nette\\Configurator', 1 => 'createServicerobotLoader', ),
		$container,
		array ( 'directory' =>  array ( 0 => $container->params['appDir'], 1 => $container->params['libsDir'], ), )
	);
	return $service;
}, array ( 0 => 'run', ));

$container->params['database'] = array (
  'driver' => 'mysql',
  'charset' => 'utf8',
  'lazy' => true,
  'host' => 'localhost',
  'user' => 'root',
  'password' => NULL,
  'database' => 'acl',
);

$container->params['tables'] = array (
  'acl' => 'gui_acl',
  'acl_privileges' => 'gui_acl_privileges',
  'acl_resources' => 'gui_acl_resources',
  'acl_roles' => 'gui_acl_roles',
  'users' => 'gui_users',
  'users_roles' => 'gui_users_roles',
);

$container->params['acl'] = array (
  'resource' => 'acl_permission',
  'privilege' => 'acl_access',
  'cache' => false,
  'programmer_mode' => true,
);

date_default_timezone_set('Europe/Prague');

Nette\Caching\Storages\FileStorage::$useDirectories = true;

foreach ($container->getServiceNamesByTag("run") as $name => $foo) { $container->getService($name); }
