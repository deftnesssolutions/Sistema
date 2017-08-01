<?php
//Constantes
$configs = new HXPHP\System\Configs\Config;
ActiveRecord\Connection::$datetime_format = 'Y-m-d H:i:s';

$configs->env->add('development');
$configs->env->development->baseURI = '/sistema/';
$configs->env->development->database->setConnectionData(array(
  'driver' => 'mysql',
  'host' => 'localhost',
  'user' => 'root',
  'password' => 'admin',
  'dbname' => 'tarefatodolit'
  ));
$configs->env->development->auth->setURLs('/sistema/home/', '/sistema/login/');
return $configs;