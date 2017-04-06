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
	private $end;
	private $status;
	// ¿private $status = [1,2,3];?
	private $worktime;

	function __construct($name="",$description="",$client_id="",$tech_id="",$start="",$end="",$status="",$worktime="",$id=null){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->client_id = $client_id;
		$this->tech_id = $tech_id;
		$this->start = $start;
		$this->end = $end;
		$this->status = $status;
		$this->worktime = $worktime;
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
								$task['task_time_seconds'],
								$task['task_id']);
		}
		return $list;

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

	function getClient(){
		$client=Client::getClientById($this->client_id);
		return $client->getName();
	}

	function setClient($client){
		$this->client_id = $client;
	}

	function getTech(){
		$tech=Tech::getTechById($this->tech_id);
		return $tech->getName();
	}

	function setTech($tech){
		$this->tech_id = $tech;
	}

	function getStart(){
		return $this->start;
	}

	function setStart($start){
		$this->start = $start;
	}

	function getEnd(){
		return $this->end;
	}

	function setEnd($end){
		$this->end = $end;
	}

	function getStatus(){
		return $this->status;
	}

	function setStatus($status){
		$this->status = $status;
	}

	function getWorktime(){
		return $this->start;
	}

	function setWorktime($worktime){
		$this->worktime = $worktime;
	}
}


