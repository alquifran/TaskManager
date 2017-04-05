<?php
namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;


class Tech
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



	public static function getTechByMail($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM technicians
			WHERE tech_mail = '$mail'");
		$tech = $req->fetch();
		return new Tech($tech['tech_id'], $tech['tech_name'], $tech['tech_mail'], $tech['tech_password']);

	}

	public static function getTechById($id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM technicians
			WHERE tech_id = '$id'");
		$tech = $req->fetch();
		return new Tech($tech['tech_id'], $tech['tech_name'], $tech['tech_mail'], $tech['tech_password']);

	}

	public static function isTech($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM technicians 
			WHERE tech_mail = '$mail'");
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
			FROM technicians 
			WHERE tech_mail = '$mail' AND tech_password = '$password'");
		if($req->rowCount()!=0){
			return true;
		}
		else{
			return false;
		}
	}

	public static function listTech(){
		$list = [];
		$db = Database::getInstance();
		$req = $db->query('SELECT * FROM technicians');
		foreach($req->fetchAll() as $tech){
			$list[] = new Tech($tech['tech_id'], $tech['tech_name'], $tech['tech_mail'], $tech['tech_password']);
	
		}

		return $list;

	}

	public static function addTech($name,$password,$mail){
		
		$db = Database::getInstance();
		$req = $db->prepare('INSERT INTO technicians 
			(tech_name,tech_password,tech_mail)
			VALUES (:name, :password, :mail )');
		$req->execute(array('name' => $name, 'password' => $password,
			'mail' => $mail ));

	}
	public static function updateTech($id, $name, $password, $mail){
		$db = Database::getInstance();
		if($password == ""){
			$req = $db->prepare('UPDATE technicians 
			SET tech_name = :name, tech_mail = :mail WHERE tech_id = :id');
			$req->execute(array('id' => $id, 'name' => $name,
			'mail' => $mail));
		}
		else{
			//En caso de que la contraseña cambie.
		}
	}

	public static function deleteTech($id){
		$db = Database::getInstance();
		$id = intval($id);
		$req = $db->prepare('DELETE FROM technicians WHERE tech_id = :id');
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

	function getMail(){
		return $this->mail;
	}

	function setMail($mail){
		$this->mail = $mail;
	}

}