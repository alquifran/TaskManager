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

	////////////////////////////////////////////////////////////////////////////
	//--------------------------------------------------------------------------
	//Funciones relacionadas con tareas
	//--------------------------------------------------------------------------
	////////////////////////////////////////////////////////////////////////////

	public function listTask(){
		$view = new View('templates/task');
		$tasks = Task::listTasks();
		$view->render('list.php', ['pageTitle'=>'Lista de tareas', 'tasks' => $tasks]);
	}

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

	public function showTask($id){
		$view = new View('templates/task');
		$task = Task::getTaskById($id);

		if(isset($_POST['assign'])){
			if(Task::getTaskById(intval($id))->getTechId() == null){
				$task = Task::getTaskById(intval($id));
				Task::updateTask($task->getName(), $task->getDescription(), $task->getClientId(), Tech::getTechByMail($_SESSION['mail'])->getId(), $task->getId());
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

	public function assignTask($id){
		if(Task::getTaskById(intval($id))->getTechId() == null){
			$task = getTaskById(intval($id));
			Task::updateTask($task->getName(), $task->getDescription(), $task->getClientId(), Tech::getTechByMail($_SESSION['mail'])->getId(), $task->getId());
			$view = new View('templates/task');


		}
		else{

		}
	}
}

