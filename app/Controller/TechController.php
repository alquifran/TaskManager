<?php
namespace TaskManager\Controller;
use TaskManager\Model\Tech;
use TaskManager\View\View;


class TechController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		session_start();
		if(isset($_SESSION['mail']) && !isset($_POST['logout'])){
			$view = new View('templates/tech');
			//echo "Soy un tech";
			$tech = Tech::getTechByMail($_SESSION['mail']);
			
			$view->render('profile.php', ['tech' => $tech, 'pageTitle' => $tech->getName() . "'s profile"]);
		}
		else{
			session_destroy();
			header('location:../login/');
		}
	}
	public function login(){
		session_start();
		
		//Comprobamos si el admin ha introducido datos.
		if(isset($_SESSION['mail'])){
			header('location:../profile/');
			die();
		}
		if(isset ($_POST['mail'])){
			//Comprobamos si el mail introducido existe
			//en nuestra base de datos
			if(Tech::isTech($_POST['mail'])){
				//Comprobamos si la contraseña coincide.
				if(Tech::checkPassword($_POST['mail'], $_POST['password'])){
					
					$_SESSION['user_type'] = 'tech';
					$_SESSION['mail'] = $_POST['mail'];
					header('Location:../profile/');
					die();
				}
			}
		}
		$view = new View('templates/tech');
		$view->render('login.php', ['pageTitle' => 'Login tech']);
	}
}

