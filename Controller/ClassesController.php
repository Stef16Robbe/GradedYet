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
							<p class='examinedAmount' id='examinedAmount".$class->id."'>".$class->examinedAmount."</p>
							<p class='totalAmount'>/".$class->amount."</p>
							<button class='plusBtn' type='button' onclick='finishedAmountPlus(".$class->id.", ".$class->amount.")'>+</button>
							<button class='minusBtn' type='button' onclick='finishedAmountMinus(".$class->id.")'>-</button>
							<button class='saveExaminedAmount' type='button' onclick='saveFinishedAmount(".$class->id.", ".$class->amount.")'>Save</button>
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