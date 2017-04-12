<?php

require 'vendor/autoload.php';
// require 'bootstrap/Request.php';
use TaskManager\Bootstrap\Request;
use TaskManager\View\View;
session_start();

$request = new Request();
// $controller = $request->getParam('controller') ?? 'page';
if($request->hasParam('controller')){
	$controller = $request->getParam('controller');
	if(isset($_SESSION['user_type']) && strtolower($controller) != strtolower($_SESSION['user_type'])){
		// echo "No tienes permiso para ver esta página. ";
		// //Hay que poner el enlace de dónde está vuestro proyecto. (Por defecto está en el mío.)
		// echo "<a href='http://localhost/TM-sourcetree/".$_SESSION['user_type']."/' >Ir a mi perfil</a>";
		$view = new View('templates/page');
		$message = "No tienes permiso para ver esta página. "."<a href='http://localhost/TM-sourcetree/".$_SESSION['user_type']."/' >Ir a mi perfil</a>";
		$view->render('error.php', ['message' => $message, 'pageTitle' => 'Error']);
		die();
	}
	else if (!isset($_SESSION['user_type'])){
		if($request->hasParam('action') && strtolower($request->getParam('action'))!= 'login'){
			echo "No estás registrado";
			die();
		}
	}
}
else{
	$controller = 'page';
}
// construimos el nombre completo del controlador
$controller = ucfirst($controller) . 'Controller';
$controller = 'TaskManager\Controller\\'. $controller;
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
