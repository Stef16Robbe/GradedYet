<?php
session_start();
require_once("Autoloader.php");
class ClassesController 
{
	private $ClassesModel;
	private $Session;
	private $Config;
	private $DB_Helper;
	private $allowedToEdit;
	private $encryptionHelper;
	private $teacherId;

	public function __construct($ClassesModel) {
		$this->allowedToEdit = false;
		$this->ClassesModel = $ClassesModel;
		$this->Config = Config::getInstance();
		$this->DB_Helper = new DB_Helper();
		$this->encryptionHelper = new EncryptionHelper();

		if (isset($_SESSION["teacherId"])) {
			$this->allowedToEdit = true;
			$this->teacherId = $this->encryptionHelper->Decrypt($_SESSION["teacherId"]);
		}

		$this->CheckClasses();
		$this->GetClasses();
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetBackButton() {
		if ($this->allowedToEdit) {
			return 
			"<a href='TeacherPage.php'>
				<i style='font-size:50px' class='fas'>&#xf060;</i>
			</a>";
		} else {
			return 
			"<a href='index.php'>
				<i style='font-size:50px' class='fas'>&#xf060;</i>
			</a>";
		}
	}

	private function CheckClasses() {
		$groupName = $_GET['groupName'];
		if ($groupName == null || empty($groupName)) {
			header("Location: TeacherPage.php");
		}
		if ($this->allowedToEdit && !$this->DB_Helper->GetClasses($groupName, $this->teacherId)) {
			header("Location: TeacherPage.php");
		}
	}

	public function GetClasses() {
		$groupName = $_GET['groupName'];
		$allClasses = "";
		if ($this->allowedToEdit) {
			$classes = $this->DB_Helper->GetTeacherClasses($groupName, $this->teacherId);
		} else {
			$classes = $this->DB_Helper->GetClasses($groupName);
		}
		
		foreach ($classes as $class) {
			$schoolName = "Hogeschool InHolland";
			if ($this->allowedToEdit) {
				// html element for class edit
				$allClasses .= "
				<div class='classCard'>
					<div class='classTitleH2'>
						<h2>".$class->name."-".$class->group."</h2>
					</div>
					<img src='./Images/trash_recyclebin_empty_closed.png' class='delIcon' onclick='deleteClass(".$class->id.")'>
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
			} else {
				// html element for viewing progress
				$allClasses .= "
				<div class='classCard'>
					<div class='classTitleH2'>
						<h2>".$class->name."-".$class->group."</h2>
					</div>
					<br />
					<br />
					<div class='classSpecifications'>
						<p class='schoolName'><b>School: </b>".$schoolName."</p>
					</div>
					<div class='classSpecifications progress'>
						<label for='classProgress'>Progress:</label>
						<progress class='progressBar' id='classProgress' value=".$class->examinedAmount." max=".$class->amount."></progress>
					</div>
				</div>
				";
			}

		}
		return $allClasses;
	}
}

?>