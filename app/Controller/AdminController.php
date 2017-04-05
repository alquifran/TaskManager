<?php
namespace TaskManager\Controller;
use TaskManager\Model\Admin;
use TaskManager\View\View;


class AdminController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		session_start();
		if(isset($_SESSION['mail']) && !isset($_POST['logout'])){
			$view = new View('templates/admin');
			//echo "Soy un admin";
			$admin = Admin::getAdminByMail($_SESSION['mail']);
			
			$view->render('profile.php', ['admin' => $admin, 'pageTitle' => $admin->getName() . "'s profile"]);
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
			if(Admin::isAdmin($_POST['mail'])){
				//Comprobamos si la contraseña coincide.
				if(Admin::checkPassword($_POST['mail'], $_POST['password'])){
					
					$_SESSION['user_type'] = 'admin';
					$_SESSION['mail'] = $_POST['mail'];
					header('Location:../profile/');
					die();
				}
			}
		}
		$view = new View('templates/admin');
		$view->render('login.php', ['pageTitle' => 'Login admin']);
	}
}

