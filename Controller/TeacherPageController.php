<?php
session_start();
require_once("Autoloader.php");
class TeacherPageController 
{
	private $TeacherPageModel;
	private $Session;
	private $Config;
	private $DB_Helper;

	public function __construct($TeacherPageModel) {
		$this->TeacherPageModel = $TeacherPageModel;
		$this->Config = Config::getInstance();		
		$this->DB_Helper = new DB_Helper();		

		if (!isset($_SESSION["teacherId"])) {
			header("Location: Login.php");
		}
		var_dump($_SESSION["teacherId"]);
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetGroups() {
		$teacherId = $_SESSION["teacherId"];
		$allGroups = "";
		$allGroups .= "<div class='classCard' id='addClassIcon' onclick='showAddClass()'> <img src='./Images/plus-2-icon-256.png'> </div>";
		$allGroups .= 
		"<div class='classCard' id='addClass'>
			<form action='AddClass.php' method='post'>
				<h1 class='classTitleH1'>New Class:</h1>
				<p id='groupNameP'>Group name: </p> <input type='text' id='groupNameTxt' name='groupName'>
				<p id='classNameP'>Class name: </p> <input type='text' id='classNameTxt' name='className'>
				<p id='totalTestsP'>Amount of tests: </p> <input type='number' id='totalTestsTxt' name='totalTests'>
				<input type='submit' id='submitNewClass' name='submitNewClass' value='Create'>
			</form>
		</div>";
		if ($groups = $this->DB_Helper->GetGroups($teacherId)) {
			foreach($groups as $group) {
				$allGroups .= 		
				"<div class='classCard'>
					<h1 class='classTitleH1'>".$group["Name"]."</h1>
					<div class='viewClassesLink'>
						<a href='Classes.php?groupName=".$group["Name"]."'><p class='classLinkP'>View your classes ></p></a>
					</div>
				</div>";
			}
		}
		return $allGroups;
	}
}

?>