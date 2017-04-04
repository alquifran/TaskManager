<?php
namespace TaskManager\Controller;
use TaskManager\Model\Client;
use TaskManager\View\View;

class ClientController
{
	public function index(){
		$view = new View('templates/client');
		//echo "Soy un cliente";
		$client = Client::getClientById(1);
		$view->render('profile.php', ['client' => $client]);
	}
}