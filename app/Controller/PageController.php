<?php
namespace TaskManager\Controller;

class PageController{

	public function index(){
		echo "<a href=Client/Login/>Client</a><br>";
		echo "<a href=Admin/Login/>Admin</a><br>";
		echo "<a href=Tech/Login/>Técnico</a><br>";
	}
	
}