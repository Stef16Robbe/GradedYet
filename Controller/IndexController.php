<?php
require_once( "Autoloader.php");
class IndexController 
{
	private $IndexModel;
	private $Session;
	private $Config;
	private $DB_Helper;

	public function __construct($indexModel) {
		$this->IndexModel = $indexModel;
		$this->Config = Config::getInstance();
		$this->DB_Helper = new DB_Helper();
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetAllGroups() {
		if ($groups = $this->DB_Helper->GetAllGroups()) {
			$allGroups = "";
			foreach ($groups as $group) {
				$allGroups .= "
				<div class='classCard'>
					<h1 class='classTitleH1'>".$group["Name"]."</h1>
					<div class='viewClassesLink'>
						<a href='Classes.php?groupName=".$group["Name"]."'><p class='classLinkP'>View classes ></p></a>
					</div>
				</div>
				";
			}
		} else {
			$allGroups .= "There are currently no available groups.";
		}
		return $allGroups;
	}
}

?>