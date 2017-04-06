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

	public function getName(){
		return $this->name;
	}
}