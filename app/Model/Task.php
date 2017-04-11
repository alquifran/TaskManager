<?php

namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;
use TaskManager\Model\Client;
use TaskManager\Model\Tech;

class Task
{
	private $id;
	private $name;
	private $description;
	private $client_id;
	private $tech_id;
	private $start;
	private $ending;
	private $status;
	// ¿private $status = [0,1,2];?
	private $workTime;

	function __construct($name="",$description="",$client_id="",$tech_id="",$start="",$ending="",$status="",$workTime="",$id=null){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->client_id = $client_id;
		$this->tech_id = $tech_id;
		$this->start = $start;
		$this->ending = $ending;
		$this->status = $status;
		$this->workTime = $workTime;
	}

	public static function listTasks(){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM tasks"
			);
		if($req->rowCount()!=0){

			$tasks = $req->fetchAll();
			foreach ($tasks as $task){
				$list[] =new Task(
								$task['task_name'],
								$task['task_description'],
								$task['client_id'],
								$task['tech_id'],
								$task['task_date_start'],
								$task['task_date_end'],
								$task['status_id'],
								$task['task_time_seconds'],
								$task['task_id']);
			}
			return $list;
		}else{

			return null;
		}

	}

	// FILTROS de tareas
	// Por cliente
	public static function listTasksByClientId($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM tasks WHERE client_id = $id"
			);

		if($req->rowCount()!=0){

			$tasks = $req->fetchAll();
			foreach ($tasks as $task){
				$list[] =new Task(
								$task['task_name'],
								$task['task_description'],
								$task['client_id'],
								$task['tech_id'],
								$task['task_date_start'],
								$task['task_date_end'],
								$task['status_id'],
								$task['task_time_seconds'],
								$task['task_id']);
			}
			return $list;
		}else{

			return null;
		}
	}

	// Por tecnico
	public static function listTasksByTechId($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM tasks WHERE tech_id = $id"
			);

		if($req->rowCount()!=0){

			$tasks = $req->fetchAll();
			foreach ($tasks as $task){
				$list[] =new Task(
								$task['task_name'],
								$task['task_description'],
								$task['client_id'],
								$task['tech_id'],
								$task['task_date_start'],
								$task['task_date_end'],
								$task['status_id'],
								$task['task_time_seconds'],
								$task['task_id']);
			}
			return $list;
		}else{

			return null;
		}
	}

	// Por estado
	public static function listTasksByStatusId($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM tasks WHERE status_id = $id"
			);
		if($req->rowCount()!=0){

			$tasks = $req->fetchAll();
			foreach ($tasks as $task){
				$list[] =new Task(
								$task['task_name'],
								$task['task_description'],
								$task['client_id'],
								$task['tech_id'],
								$task['task_date_start'],
								$task['task_date_end'],
								$task['status_id'],
								$task['task_time_seconds'],
								$task['task_id']);
			}
			return $list;
		}else{

			return null;
		}
	}

	public static function filterListTask($client_id, $tech_id, $status_id){
		if($client_id == $tech_id  && $tech_id == $status_id && $status_id == null){
			return self::listTasks();
		}
		else{
			$db = Database::getInstance();
			$queryString = "";
			if($client_id == '-1'){
				$queryString .= " client_id IS NULL AND ";
			}
			else if($client_id != null){
				$queryString .= " client_id = " . $client_id . " AND ";
			}

			if($tech_id == '-1'){
				$queryString .= " tech_id IS NULL AND ";
			}
			else if($tech_id != null){
				$queryString .= " tech_id =" . $tech_id . " AND ";
			}

			if($status_id != null){
				$queryString .= " status_id =" . $status_id . " AND ";
			}


			$req = $db->query("
			SELECT *
			FROM tasks WHERE ".$queryString." 1 " 
			);
			if($req->rowCount()!=0){
				$tasks = $req->fetchAll();
				foreach ($tasks as $task) {
					$list[] =new Task(
									$task['task_name'],
									$task['task_description'],
									$task['client_id'],
									$task['tech_id'],
									$task['task_date_start'],
									$task['task_date_end'],
									$task['status_id'],
									$task['task_time_seconds'],
									$task['task_id']);
				}
				return $list;
			}
			else{
				return null;
			}
		}
	}


	//FIN FILTROS

	public static function getTaskById($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM tasks
			WHERE task_id = '$id'");
		$task = $req->fetch();
		return new Task(
								$task['task_name'],
								$task['task_description'],
								$task['client_id'],
								$task['tech_id'],
								$task['task_date_start'],
								$task['task_date_end'],
								$task['status_id'],
								$task['task_time_seconds'],
								$task['task_id']);;

	}

	public static function addTask($name,$description,$client_id=null,$tech_id=null,$status=0,$workTime=0){

		$db = Database::getInstance();
		$req = $db->prepare('INSERT INTO tasks
			(task_name,task_description,client_id,tech_id,status_id,task_time_seconds)
			VALUES (:name, :description, :client_id, :tech_id, :status, :workTime)');
		$req->execute(array(
				'name' => $name,
				'description' => $description,
				'client_id' => $client_id,
				'tech_id' => $tech_id,
				'status' => $status,
				'workTime' => $workTime
				)
		);

	}

	public static function updateTask($name,$description,$client_id,$tech_id,$status,$id){
		$db = Database::getInstance();
		if($client_id == ""){
			$client_id = null;
		}

		if($tech_id == ""){
			$tech_id = null;
		}
		$req = $db->prepare('UPDATE tasks
			SET
				task_name = :name,
				task_description = :description,
				client_id = :client_id,
				tech_id = :tech_id,
				status_id = :status
			WHERE task_id = :id');
			$req->execute(array(
				'name' => $name,
				'description' => $description,
				'client_id' => $client_id,
				'tech_id' => $tech_id,
				'id' => $id,
				'status' => $status
				)
			);


	}
	//Funciones con el tiempo.
	// Añadir tiempo a una tarea.
	public static function addworkTime($id, $workTime){
		$task = self::getTaskById($id);
		$currentTime= $task->getworkTime();

		$totalTime = $currentTime + $workTime * 60;
		
		$db = Database::getInstance();
		$req = $db->prepare('UPDATE tasks
			SET
				task_time_seconds = :totalTime
			WHERE task_id = :id');
			$req->execute(array(
				'id' => $id,
				'totalTime' => $totalTime
				)
			);
	}
	//Obtener el tiempo total empleado en las tareas de un cliente.
	public static function sumAllClientTime($client_id){
		$db = Database::getInstance();
		$req = $db->prepare('SELECT SUM(task_time_seconds) as totalTime FROM tasks
			WHERE client_id = :client_id');
			$req->execute(array(
				'client_id' => $client_id,
				)
			);
		$time = $req->fetch();
		return $time['totalTime']/60;
	}
	// Obtener el tiempo total que lleva empleado un técnico en sus tareas.
	public static function sumAllTechTime($tech_id){

		$db = Database::getInstance();
		$req = $db->prepare('SELECT SUM(task_time_seconds) as totalTime FROM tasks
			WHERE tech_id = :tech_id');
			$req->execute(array(
				'tech_id' => $tech_id,
				)
			);
		$time = $req->fetch();
		return $time['totalTime']/60;
	}

	// Fin Funciones con el tiempo
	
	public static function deleteTask($id){
		$db = Database::getInstance();
		$id = intval($id);
		$req = $db->prepare('DELETE FROM tasks WHERE task_id = :id');
		$req->execute(array('id' => $id));
	}

	//GETTERS Y SETTERS
	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}

	function getDescription(){
		return $this->description;
	}

	function setDescription($description){
		$this->description = $description;
	}

	function getClientByName(){
		$client=Client::getClientById($this->client_id);
		return $client->getName();
	}

	function getClientId(){
		return $this->client_id;
	}

	function setClientId($client){
		$this->client_id = $client;
	}

	function getClient(){
		$client=Client::getClientById($this->client_id);
		return $client;
	}

	function getTech(){
		$tech=Tech::getTechById($this->tech_id);
		return $tech;
	}

	function setTechId($tech){
		$this->tech_id = $tech;
	}

	function getTechId(){
		return $this->tech_id;
	}


	function getStart(){
		return $this->start;
	}

	function setStart($start){
		$this->start = $start;
	}

	function getEnding(){
		return $this->ending;
	}

	function setEnding($ending){
		$this->ending = $ending;
	}

	function getStatus(){
		return $this->status;
	}

	function setStatus($status){
		$this->status = $status;
	}

	function getStatusText(){
		switch ($this->status) {
			case 0:
				return "Por empezar";
				break;
			
			case 1:
				return "Haciéndose";
				break;

			case 2:
				return "Terminada";
				break;

			default:
				return "Desconocido";
				break;
		}
	}


	function getworkTime(){
		return $this->workTime;
	}

	function setworkTime($workTime){
		$this->workTime = $workTime;
	}

	function getworkTimeAsMin(){
		return (($this->workTime - ($this->workTime % 60))/ 60) ;
	}

}
