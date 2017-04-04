<?php
namespace TaskManager\View;
class View{
	protected $templatePath;
	protected $attributes;
	public function __construct($templatePath = "", $attributes = [])
	{
		$this->templatePath = rtrim($templatePath, '/\\') . '/';
		$this->attributes = $attributes;
	}
	public function render($template, $data = [])
	{
		 $thispath = __DIR__;

		 $thispath = str_replace("\\View", "", $thispath); 
		//set_include_path('C:\\new\\xampp\\htdocs\\fran\\php\\cp-pisos\\app');
		set_include_path($thispath);
		$data = array_merge($this->attributes, $data);
		$templateFile = $this->templatePath . $template;
		extract($data);
		ob_start();
		include $templateFile;
		$pageContent = ob_get_clean();
		include 'app/templates/layout/frontend.php';
	}
}
