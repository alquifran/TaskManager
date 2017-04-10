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

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con clientes
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////

	public function addClient(){
		if(empty($_POST)){
			$view = new View('templates/client');
			$view->render('add.php', []);
		}
		else{
			
			Client::addClient($_POST['name'], $_POST['password'], $_POST['mail']);
			$_POST = "";
			header('Location:../');
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
			$view->render('update.php', ['client' => $client]);
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
			header('Location:../');
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
			$view->render('add.php', []);
		}
		else{
			
			Tech::addTech($_POST['name'], $_POST['password'], $_POST['mail']);
			$_POST = "";
			header('Location:../');
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
			$view->render('update.php', ['tech' => $tech]);
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
			header('Location:../');
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
			$clients = Client::listClient();
			$techs = Tech::listTech();
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
			header('Location:../');
		}
	}

	public function listTask(){
		$view = new View('templates/task');
		$tasks = Task::listTasks();
		$view->render('list.php', ['pageTitle'=>'Lista de tareas', 'tasks' => $tasks]);
	}

	public function showTask($id){
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
			$techs = Tech::listTech();
			$clients = Client::listClient();

			$view->render('update.php', ['task' => $task, 'techs' => $techs, 'clients' => $clients]);
		}
		else{
			
			Task::updateTask($_POST['name'], $_POST['desc'], $_POST['client_id'], $_POST['tech_id'],$_POST['status_id'], $id);
			$_POST = "";
			header('Location:../');
		}

	}
}

