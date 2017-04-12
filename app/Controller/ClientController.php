<?php
namespace TaskManager\Controller;
use TaskManager\Model\Client;
use TaskManager\View\View;
use TaskManager\Model\Pack;
use TaskManager\Model\Task;
use TaskManager\Model\Tech;


class ClientController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		
		if(isset($_SESSION['mail']) && !isset($_POST['logout'])){
			$view = new View('templates/client');
			//echo "Soy un cliente";
			$client = Client::getClientByMail($_SESSION['mail']);
			$packs = Pack::packsByClientId($client->getId());
			$tasks = Task::listTasksByClientId($client->getId());
			$totaltime = Task::sumAllClientTime($client->getId());
			

			$view->render('profile.php', ['client' => $client, 'pageTitle' => $client->getName() . "'s profile", 'packs' => $packs, 'tasks' => $tasks, 'time' => $totaltime]);
		}
		else{
			session_destroy();
			header('location:../../');
		}
	}



	public function login(){
		
		$message = "";
		//Comprobamos si el cliente ha introducido datos.
		if(isset($_SESSION['mail'])){
			header('location:../profile/');
			die();
		}
		if(isset ($_POST['mail'])){
			//Comprobamos si el mail introducido existe
			//en nuestra base de datos
			if(Client::isClient($_POST['mail'])){
				//Comprobamos si la contraseña coincide.
				if(Client::checkPassword($_POST['mail'], $_POST['password'])){
					if(Client::getClientByMail($_POST['mail'])->getAlta()){
						$_SESSION['user_type'] = 'client';
						$_SESSION['mail'] = $_POST['mail'];
						$_POST[] = "";
						header('Location:../profile/');
						die();
					}
					else{
						$message = "Su usuario está dado de baja. Por favor, póngase en contacto con el administrador: (email del administrador)";
					}
				}
				else{
					$message = "La contraseña introducida no es correcta";
				}
			}
			else{
				$message = "El usuario introducido no existe";
			}
		}

		$view = new View('templates/client');
		$view->render('login.php', ['pageTitle' => 'Login client', 'message' => $message]);
	}

	public function listPacks(){
		$packs = Pack::listPacks();
		$view = new View('templates/pack');
		$view->render('list.php', ['packs' => $packs]);
	}

	public function addPack(){
		
		$pack = Pack::PackById($_POST['pack']);
		$client_id = Client::getClientByMail($_SESSION['mail'])->getId();
		$pack_id = $pack->getId();
		Pack::contractPack($pack_id,$client_id);
		header('location:../profile/');

	}
	public function addTask(){
		if(empty($_POST)){
			$view = new View('templates/task');
			
			$view->render('addByClient.php', ['pageTitle' => 'Crear tarea']);		
		}else{
			$client_id = Client::getClientByMail($_SESSION['mail'])->getId();
			Task::addTask($_POST['name'], $_POST['desc'], $client_id);
			$_POST = "";
			header('Location:../');
		}

		
	}
}



