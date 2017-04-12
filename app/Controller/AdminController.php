<?php
namespace TaskManager\Controller;
use TaskManager\Model\Admin;
use TaskManager\Model\Client;
use TaskManager\Model\Tech;
use TaskManager\Model\Task;
use TaskManager\View\View;


class AdminController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		
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
		$message = "";
		
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
					$_POST[] = "";
					die();
				}
				else{

					$message = "La contraseña es incorrecta.";
				}
			}
			else{
				$message = "El usuario introducido no existe o es incorrecto.";
			}
		}
		$view = new View('templates/admin');
		$view->render('login.php', ['pageTitle' => 'Login admin', 'message' => $message]);
	}

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con clientes
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////

	public function addClient(){
		if(empty($_POST)){
			$view = new View('templates/client');
			$view->render('add.php', ['pageTitle'=>"Crear cliente"]);
		}
		else{
			
			Client::addClient($_POST['name'], $_POST['password'], $_POST['mail']);
			$_POST = "";
			header('Location:../listClient/');
		}

	}

	public function listClient(){
		
		$view = new View('templates/client');
		$listClients = Client::listClient();
		$view->render('list.php', ['clients' => $listClients, 'pageTitle'=>"Listado de clientes"]);

	}

	public function showClient($id){
		$view = new View('templates/client');
		$client = Client::getClientById($id);
		$view->render('show.php', ['client' => $client]);
	}

	public function updateClient($id){
		// if(checkLogin($_POST));
		if(empty($_POST)){
			$view = new View('templates/client');
			$client = Client::getClientById($id);
			$view->render('update.php', ['client' => $client, 'pageTitle'=>"Modificar cliente ".$client->getName()]);
		}
		else{
			if(isset($_POST['alta']) && ($_POST['alta'] == 1)){
				$alta = 1;
			}
			else{
				$alta = 0;
			}
			Client::updateClient($id, $_POST['name'], $_POST['password'], $_POST['mail'], $alta);
			$_POST = "";
			header('Location:../listClient/');
		}
	}

	public function deleteClient($id){
		$view = new View('templates/');
		Client::deleteClient($id);
		header('Location:../listClient/');
	}

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con técnicos
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////


	public function listTech(){
		
		$view = new View('templates/tech');
		$listTechs = Tech::listTech();
		$view->render('list.php', ['techs' => $listTechs, 'pageTitle'=>"Listado de técnicos"]);

	}

	public function showTech($id){
		$view = new View('templates/tech');
		$tech = Tech::getTechById($id);
		$view->render('show.php', ['tech' => $tech]);
	}

	public function addTech(){
		if(empty($_POST)){
			$view = new View('templates/tech');
			$view->render('add.php', ['pageTitle'=>"Crear técnico"]);
		}
		else{
			
			Tech::addTech($_POST['name'], $_POST['password'], $_POST['mail']);
			$_POST = "";
			header('Location:../listTech/');
		}

	}
	public function deleteTech($id){
		$view = new View('templates/');
		Tech::deleteTech($id);
		header('Location:../listTech/');
	}

	public function updateTech($id){
		// if(checkLogin($_POST));
		if(empty($_POST)){
			$view = new View('templates/tech');
			$tech = Tech::getTechById($id);
			$view->render('update.php', ['tech' => $tech, 'pageTitle'=>"Modificar técnico ".$tech->getName()]);
		}
		else{
			if(isset($_POST['alta']) && ($_POST['alta'] == 1)){
				$alta = 1;
			}
			else{
				$alta = 0;
			}
			Tech::updateTech($id, $_POST['name'], $_POST['password'], $_POST['mail'], $alta);
			$_POST = "";
			header('Location:../listTech/');
		}
	}

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con tareas
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////


	public function addTask(){
		if(empty($_POST)){
			$view = new View('templates/task');
			$clients = Client::listAltaClient();
			$techs = Tech::listAltaTech();
			$view->render('add.php', ['clients' => $clients, 'techs' => $techs, 'pageTitle' => 'Crear tarea']);
		}
		else{
			if($_POST['client_id'] == ""){
				$_POST['client_id'] = null;
			}
			if($_POST['tech_id'] == ""){
				$_POST['tech_id'] = null;
			}
			Task::addTask($_POST['name'], $_POST['desc'], $_POST['client_id'], $_POST['tech_id']);
			$_POST = "";
			header('Location:../listTask/');
		}
	}

	public function listTask(){
		$view = new View('templates/task');
		$client_id = $tech_id = $status_id = null;

		if (isset($_POST['reset'])){
			$_POST = "";
		}
		if(isset($_POST['client_id']) && $_POST['client_id'] != ""){
			$client_id = $_POST['client_id'];
		}

		if(isset($_POST['tech_id']) && $_POST['tech_id'] != ""){
			$tech_id = $_POST['tech_id'];
		}

		if(isset($_POST['status_id']) && $_POST['status_id'] != ""){
			$status_id = $_POST['status_id'];
		}




		$tasks = Task::filterListTask($client_id, $tech_id, $status_id);
		$clients = Client::listClient();
		$techs = Tech::listTech();

		$view->render('list.php', ['pageTitle'=>'Lista de tareas', 'tasks' => $tasks, 'clients' => $clients, 'techs' => $techs, 'status_id' => $status_id, 'client_id' => $client_id, 'tech_id' => $tech_id]);
	}

	public function showTask($id){
		if(isset($_POST['addTime'])){
			Task::addworkTime($id, $_POST['workTime']);
			$_POST = "";
		}

		$view = new View('templates/task');
		$task = Task::getTaskById($id);
		$view->render('show.php', ['pageTitle'=>$task->getName(), 'task' => $task]);
	}

	public function deleteTask($id){

		Task::deleteTask($id);
		header('Location:../listTask/');
	}

	public function updateTask($id){
		if(empty($_POST)){
			$view = new View('templates/task');
			$task = Task::getTaskById($id);
			$techs = Tech::listAltaTech();
			$clients = Client::listAltaClient();

			$view->render('update.php', ['task' => $task, 'techs' => $techs, 'clients' => $clients]);
		}
		else{
			
			Task::updateTask($_POST['name'], $_POST['desc'], $_POST['client_id'], $_POST['tech_id'],$_POST['status_id'], $id);
			$_POST = "";
			header('Location:../listTask/');
		}

	}
}

