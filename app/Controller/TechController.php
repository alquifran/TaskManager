<?php
namespace TaskManager\Controller;
use TaskManager\Model\Tech;
use TaskManager\Model\Client;
use TaskManager\Model\Task;
use TaskManager\View\View;


class TechController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		
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
		
		$message ="";
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
					if(Tech::getTechByMail($_POST['mail'])->getAlta()){
						$_SESSION['user_type'] = 'tech';
						$_SESSION['mail'] = $_POST['mail'];
						header('Location:../profile/');
						$_POST[] = "";
						die();
					}else{
						$message = "Su usuario está dado de baja. Por favor, póngase en contacto con el administrador: admin@admin.com";
					}
				}else{
					$message = "La contraseña introducida no es correcta";
				}
			}else{
				$message = "El usuario introducido no existe";
		}}
		$view = new View('templates/tech');
		$view->render('login.php', ['pageTitle' => 'Login tech', 'message' => $message]);
	}

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con tareas
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////

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

		$view->render('listTech.php', ['pageTitle'=>'Lista de tareas', 'tasks' => $tasks, 'clients' => $clients, 'techs' => $techs, 'status_id' => $status_id, 'client_id' => $client_id, 'tech_id' => $tech_id]);
	}

	public function addTask(){
		if(empty($_POST)){
			$view = new View('templates/task');
			$clients = Client::listAltaClient();
			$techs = Tech::listTech();
			$view->render('add.php', ['clients' => $clients, 'techs' => $techs, 'pageTitle' => 'Crear tarea']);
		}
		else{
			$tech_id = null;
			if($_POST['client_id'] == ""){
				$_POST['client_id'] = null;
			}
			if($_POST['self_assign'] == "assign"){
				$tech_id = Tech::getTechByMail($_SESSION['mail'])->getId();
			}
			Task::addTask($_POST['name'], $_POST['desc'], $_POST['client_id'], $tech_id);
			$_POST = "";
			header('Location:../listTask/');
		}
	}

	public function showTask($id){
		if(isset($_POST['addTime'])){
			Task::addworkTime($id, $_POST['workTime']);
			$_POST = "";
		}

		$view = new View('templates/task');
		$task = Task::getTaskById($id);

		if(isset($_POST['assign'])){
			if(Task::getTaskById(intval($id))->getTechId() == null){
				$task = Task::getTaskById(intval($id));
				Task::updateTask($task->getName(), $task->getDescription(), $task->getClientId(), Tech::getTechByMail($_SESSION['mail'])->getId(),$task->getStatus(), $task->getId());
			}
		}
		if($task->getId() == null){
			echo "No existe la tarea solicitada. ";
			echo "<a href='../ListTask/' >Volver a la lista</a>";
		}
		else if($task->getTechId() == null || $task->getTech()->getMail() == $_SESSION['mail']){
			$task = Task::getTaskById($id);
			$view->render('show.php', ['pageTitle'=>$task->getName(), 'task' => $task]);
			
		}
		else{
			echo "No tienes permiso para ver esta página. ";
		//Hay que poner el enlace de dónde está vuestro proyecto. (Por defecto está en el mío.)
			echo "<a href='../ListTask/' >Volver a la lista</a>";
		}
	}



	public function updateTask($id){
		if(empty($_POST)){
			$view = new View('templates/task');
			$task = Task::getTaskById($id);

			$view->render('update.php', ['task' => $task, 'isTech' => true, 'pageTitle' => 'Editar tarea']);
		}
		else{
			
			$task = Task::getTaskById($id);
			Task::updateTask($task->getName(), $_POST['desc'], $task->getClientId(), $task->getTechId(), $_POST['status_id'], $id);
			$_POST = "";
			header('Location:../');
		}
	}
}

