<?php
require_once( "Autoloader.php");
class ClassesController 
{
	private $ClassesModel;
	private $Session;
	private $Config;

	public function __construct($ClassesModel){
		$this->ClassesModel = $ClassesModel;
		$this->Config = Config::getInstance();
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}
}

?>