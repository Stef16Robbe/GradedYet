<?php
require_once("Autoloader.php");
class TeacherPageController 
{
	private $TeacherPageModel;
	private $Session;
	private $Config;
	private $DB_Helper;

	public function __construct($TeacherPageModel){
		$this->TeacherPageModel = $TeacherPageModel;
		$this->Config = Config::getInstance();		
		$this->DB_Helper = new DB_Helper();
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetGroups() {
		$allGroups = "";
		$teacherId = $_SESSION["teacherId"];
		$groups = $this->DB_Helper->GetGroups($teacherId);

		foreach($groups as $group) {
			$allGroups .= 		
			"<div class='classCard'>
				<h1 class='classTitleH1'>".$group["Name"]."</h1>
				<div class='viewClassesLink'>
					<a href='Classes.php?groupId=".$group["Id"]."'><p class='classLinkP'>View your classes ></p></a>
				</div>
			</div>";
		}
		return $allGroups;
	}
}

?>