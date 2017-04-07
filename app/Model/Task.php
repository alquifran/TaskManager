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
								$task['task_id']); ;

	}

	public static function addTask($name,$description,$client_id=null,$tech_id=null,$status=0){

		$db = Database::getInstance();
		$req = $db->prepare('INSERT INTO tasks
			(task_name,task_description,client_id,tech_id,status_id)
			VALUES (:name, :description, :client_id, :tech_id, :status )');
		$req->execute(array(
				'name' => $name,
				'description' => $description,
				'client_id' => $client_id,
				'tech_id' => $tech_id,
				'status' => $status
				)
		);

	}

	public static function updateTask($name,$description,$client_id,$tech_id,$start,$ending,$status,$workTime,$id){
		$db = Database::getInstance();

		$req = $db->prepare('UPDATE tasks
			SET
				task_name = :name,
				task_description = :description,
				client_id = :client_id,
				tech_id = :tech_id,
				task_date_start = :start,
				task_date_end = :ending,
				status_id = :status,
				task_time_seconds = :workTime
			WHERE task_id = :id');

			$req->execute(array(
				'name' => $name,
				'description' => $description,
				'client_id' => $client_id,
				'tech_id' => $tech_id,
				'start' => $start,
				'ending' => $ending,
				'status' => $status,
				'workTime' => $workTime,
				'id' => $id
				)
			);


	}

	public static function deleteTask($id){
		$db = Database::getInstance();
		$id = intval($id);
		$req = $db->prepare('DELETE FROM tasks WHERE task_id = :id');
		$req->execute(array('id' => $id));
	}

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
		return $this->start;
	}

	function setworkTime($workTime){
		$this->workTime = $workTime;
	}
}


