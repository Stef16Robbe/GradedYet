<?php
session_start();
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
		$this->GetClasses();
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetClasses() {
		$groupName = $_GET['groupName'];
		$allClasses = "";
		if ($groupName != null && !empty($groupName)) {
			if ($classes = $this->DB_Helper->GetClasses($groupName, $_SESSION["teacherId"])) {
				foreach ($classes as $class) {
					// html element for class edit / add / subtraction
					$schoolName = "Hogeschool InHolland";
					$allClasses .= "
					<div class='classCard'>
						<div class='classTitleH2'>
							<h2>".$class->name."-".$class->group."</h2>
						</div>
						<img src='./Images/trash_recyclebin_empty_closed.png' class='delIcon'>
						<div class='classSpecifications'>
							<p class='schoolName'><b>School:</b> ".$schoolName."</p>
						</div>
						<div class='classSpecifications progress'>
							<p><b>Progress:</b></p>
							<form method='post' action='UpdateExaminedAmount.php' class='editExaminedAmount'>
								<input type='text' name='examinedAmount' value=".$class->examinedAmount." class='examinedAmountTxt'>
								<input type='hidden' name='totalAmount' value=".$class->amount." style='display:none'>
								<input type='hidden' name='id' value=".$class->id." style='display:none'>
								<input type='hidden' name='groupName' value=".$groupName." style='display:none'>
								<p class='totalAmount'>/".$class->amount."</p>
								<input type='submit' name='saveExaminedAmount' class='saveExaminedAmount' value='Save'>
							</form>
						</div>
            		</div>
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