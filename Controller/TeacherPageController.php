<?php
require_once("Autoloader.php");
class TeacherPageController 
{
	private $TeacherPageModel;
	private $Session;
	private $Config;

	public function __construct($TeacherPageModel){
		$this->TeacherPageModel = $TeacherPageModel;
		$this->Config = Config::getInstance();
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}
}

?>