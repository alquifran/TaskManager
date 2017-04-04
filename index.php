<?php

require 'vendor/autoload.php';
// require 'bootstrap/Request.php';
use TaskManager\Bootstrap\Request;
$request = new Request();
// $controller = $request->getParam('controller') ?? 'page';
if($request->hasParam('controller')){
	$controller = $request->getParam('controller');
}
else{
	$controller = 'page';
}
// construimos el nombre completo del controlador
$controller = ucfirst($controller) . 'Controller';
$controller = 'TaskManager\\'. $controller;
// obtenemos el parámetro o asignamos un valor por defecto
//$action = $request->getParam('action') ?? 'index';
if($request->hasParam('action')){
	$action = $request->getParam('action');
}
else{
	$action = 'index';
}
// intanciamos el controlador
$controller = new $controller;
// y llamamos a la "acción"/método pasando el id si lo hay
$controller->$action($request->getParam('id')); 