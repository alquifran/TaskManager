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