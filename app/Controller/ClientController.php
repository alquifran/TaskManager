<?php
namespace TaskManager\Controller;
use TaskManager\Model\Client;
use TaskManager\View\View;

class ClientController
{
	public function index(){
		$view = new View('templates/client');
		//echo "Soy un cliente";
		$client = Client::getClientById(1);
		$view->render('profile.php', ['client' => $client, 'pageTitle' => $client->getName() . "'s profile"]);
	}
	public function login(){
		$view = new View('templates/client');
			$view->render('login.php', ['pageTitle' => 'Login client']);
		//Comprobamos si el cliente ha introducido datos.
		if(isset ($_POST['mail'])){
			//Comprobamos si el mail introducido existe
			//en nuestra base de datos
			if(Client::isClient($_POST['mail'])){
				//Comprobamos si la contraseña coincide.
				if(Client::checkPassword($_POST['mail'], $_POST['password'])){
					session_start();
					$_SESSION['user_type'] = 'client';
					$_SESSION['mail'] = $_POST['mail'];
					header('Location:index/');
					die();
				}
			}
		}
			
	}
}



