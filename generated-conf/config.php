<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('chatstorm', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=chatstorm2',
  'user' => 'root',
  'password' => 'bigguccisosa',
));
$manager->setName('chatstorm');
$serviceContainer->setConnectionManager('chatstorm', $manager);
$serviceContainer->setDefaultDatasource('chatstorm');