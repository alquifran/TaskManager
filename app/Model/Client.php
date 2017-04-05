<?php
namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;


class Client
{
	private $name;
	private $password;
	private $mail;
	private $id;


	function __construct(
		$id=null,
		$name = "",
		$mail = "",
		$password = "")
	{
		$this->id=$id;
		$this->name = $name;
		$this->mail = $mail;
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
		return new Client($client['client_id'], $client['client_name'], $client['client_mail'], $client['client_password']);

	}

	public static function getClientByMail($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM clients 
			WHERE client_mail = '$mail'");
		$client = $req->fetch();
		return new Client($client['client_id'], $client['client_name'], $client['client_mail'], $client['client_password']);

	}

	public static function isClient($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM clients 
			WHERE client_mail = '$mail'");
		if($req->rowCount()!=0){
			return true;
		}
		else{
			return false;
		}
	}

	public static function checkPassword($mail, $password){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM clients 
			WHERE client_mail = '$mail' AND client_password = '$password'");
		if($req->rowCount()!=0){
			return true;
		}
		else{
			return false;
		}
	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}

	function getMail(){
		return $this->mail;
	}

	function setMail($mail){
		$this->mail = $mail;
	}

}
