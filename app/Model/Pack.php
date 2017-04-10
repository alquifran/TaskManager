<?php

namespace TaskManager\Model;
use TaskManager\Bootstrap\Database;

class Pack
{
	private $id;
	private $name;
	private $desc;
	private $pack_time;

	public function __construct($name = "", $desc = "", $pack_time = "", $id = null){
		$this->name = $name;
		$this->desc = $desc;
		$this->pack_time = $pack_time;
		$this->id = $id;
	}

	public static function listPacks(){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT *
			FROM packs"
			);
		$packs = $req->fetchAll();
		foreach ($packs as $pack) {
				$list[] =new Pack(
								$pack['pack_name'],
								$pack['pack_desc'],
								$pack['pack_time'],
								$pack['pack_id']);
		}
		return $list;
	}

	public static function packsByClientId($client_id){
		$db = Database::getInstance();
		$req = $db->query("
			SELECT * FROM `clients`
			JOIN `client_pack`
			ON `clients`.`client_id` = `client_pack`.`client_id`
			JOIN `packs`
			ON `client_pack`.`pack_id` = `packs`.`pack_id`
			WHERE `clients`.`client_id` = '$client_id'");


		if($req->rowCount()!=0){
			$packs = $req->fetchAll();
			foreach($packs as $pack){
				$list[]= new Pack($pack['pack_name'], $pack['pack_desc'], $pack['pack_time'], $pack['pack_id']);
			}

			return $list;
		}
		else{
			return null;
		}
	}

	public function packById($pack_id){
		$db = Database::getInstance();
		$req = $db->query("SELECT * FROM packs WHERE pack_id = $pack_id");

		if($req->rowCount()!=0){
			$pack = $req->fetch();
			return new Pack($pack['pack_name'], $pack['pack_desc'], $pack['pack_time'], $pack['pack_id']);
		}
		else{
			return null;
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public static function contractPack($pack_id,$client_id){
		$db = Database::getInstance();
		$req = $db->query("INSERT INTO client_pack (pack_id,client_id) VALUES ($pack_id,$client_id)");
	}


}