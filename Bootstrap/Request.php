<?php
namespace TaskManager\Bootstrap;
class Request
{
	private $domain;
	private $path;
	private $params;
	private $method;
	public function __construct() {
		$this->domain = $_SERVER['HTTP_HOST'];
		$this->path = explode('?', $_SERVER['REQUEST_URI'])[0];
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->params = array_merge($_POST, $_GET);
	}
	
	public function getUrl() {
		return $this->domain . $this->path;
	}
	
	public function getDomain() {
		return $this->domain;
	}
	
	public function getPath() {
		return $this->path;
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function getParam($name) {
		// return $this->params[$name] ?? null;
		if($this->hasParam($name)){
			return $this->params[$name] ;
		}
		else{
			return null;
		}

	}
	
	public function hasParam($name) {
		return isset($this->params[$name]);
	}
	
}