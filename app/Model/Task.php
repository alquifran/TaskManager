<?php

namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;

class Task
{
	private $id;
	private $name;
	private $description;

	function __construct($name="",$description="",$id=null){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
	}

	public static function listTasks(){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM tasks" 
			);
		$tasks = $req->fetchAll();
		foreach $tasks as $task{
				$list[] =new Task($task['task_name'],$task['task_description'],$task['task_id']);
		}
		return $list;

	}


	
	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}



}