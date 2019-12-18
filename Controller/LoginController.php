<?php
require_once( "Autoloader.php");
class LoginController 
{
	private $LoginModel;
	private $Session;
	private $Config;

	public function __construct($LoginModel){
		$this->IndexModel = $LoginModel;
		$this->Config = Config::getInstance();
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}
}

?>