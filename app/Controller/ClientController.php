<?php
namespace TaskManager\Controller;
use TaskManager\Model\Client;

class ClientController
{
	public function index(){
		echo "Soy un cliente";
		$clients = Client::listClient();
		foreach($clients as $client){
			echo $client->getName();
			echo "<br>";
		}

	}
}