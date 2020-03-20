<?php
require_once( "Autoloader.php");
class ClassesController 
{
	private $ClassesModel;
	private $Session;
	private $Config;
	private $DB_Helper;

	public function __construct($ClassesModel){
		$this->ClassesModel = $ClassesModel;
		$this->Config = Config::getInstance();
		$this->DB_Helper = new DB_Helper();
		$this->GetClasses($_GET['groupName']);
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	private function GetClasses($groupName) {
		$allClasses = "";
		if ($groupName != null && !empty($groupName)) {
			if ($classes = $this->DB_Helper->GetClasses($groupName, $_SESSION["teacherId"])) {
				foreach ($classes as $class) {
					// html element for class edit / add / subtraction
					$allClasses .= "
					<div class='editClass'>
						<div class='classGName'>
							".$class->name." - ".$groupName."
						</div>
						<div class='delLogo'>
							image
						</div>
						<div class='schoolName'>
							school name
						</div>
						<div class='progress'>
							progress: PROGRDONE / PROGRTOT
							image
							image
						</div>
					</div
					";
				}
			} else {
				echo("Invalid group specified.");
				// invalid group... ?
			}
		} else {
			echo("Invalid group specified.");
			// 404 not found... ?
		}
		return $allClasses;
	}
}

?>