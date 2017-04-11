<?php
namespace TaskManager\Model;
//require_once 'Bootstrap\Database.php';
use TaskManager\Bootstrap\Database;


class Admin
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



	public static function getAdminByMail($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM admins 
			WHERE admin_mail = '$mail'");
		$admin = $req->fetch();
		return new Admin($admin['admin_id'], $admin['admin_name'], $admin['admin_mail'], $admin['admin_password']);

	}

	public static function isAdmin($mail){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * 
			FROM admins 
			WHERE admin_mail = '$mail'");
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
			FROM admins 
			WHERE admin_mail = '$mail'");
		if($req->rowCount()!=0){
			$admin_res = $req->fetch();
			if(password_verify($password, $admin_res['admin_password'])){
				return true;
			}
			else{
				return false;
			}
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