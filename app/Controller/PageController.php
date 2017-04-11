<?php
namespace TaskManager\Controller;
use TaskManager\View\View;

class PageController{

	public function index(){
		if(isset($_SESSION['mail'])){

			header("location:".$_SESSION['user_type']."/profile/");
			die();
		}
		
		$view = new View('templates/page');
		$view->render('inicio.php', ['pageTitle' => 'Bienvenidos']);
	}
	
}