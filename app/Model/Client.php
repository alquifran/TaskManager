<?php
namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;


class Client{
	private $name;
	private $password;
	private $id;

	function __construct(
		$id=null,
		$name = "",
		$password = "")
	{
		$this->id=$id;
		$this->name = $name;
		$this->password=$password;

	}
	public static function listClient(){
		$list = [];
		$db = Database::getInstance();
		$req = $db->query('SELECT * FROM clients');
		foreach($req->fetchAll() as $client){
			$list[] = new Client($client['client_id'], $client['client_name'], $client['client_password']);
		}

		return $list;

	}

	public static function getClientById($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM clients 
			WHERE client_id = '$id'");
		$client = $req->fetch();
		return new Client($client['client_id'], $client['client_name'], $client['client_password']);

	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}

}
