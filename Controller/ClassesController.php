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
		$this->GetClasses($_GET['groupId']);
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	private function GetClasses($groupId) {
		$allClasses = "";
		if ($groupId != null && !empty($groupId)) {
			if ($groupName = $this->DB_Helper->GetGroupName($groupId)) {
				if ($classes = $this->DB_Helper->GetClasses($groupId)) {
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
				}
			} else {
				// invalid group... ?
			}
		} else {
			// 404 not found... ?
		}
		return $allClasses;
	}
}

?>