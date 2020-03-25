<?php 
require_once("Autoloader.php");

class ClassesView
{
	private $ClassesController;
	private $ClassesModel;

	public function __construct($ClassesController, $ClassesModel)
	{
		$this->ClassesController = $ClassesController;
		$this->ClassesModel = $ClassesModel;
	}

	public function output(){
		$page = "";
		$page .= $this->Header();
		$page .= $this->Body();
		$page .= $this->Footer();
		return $page;
	}

	private function Header() {
		return "
		<!DOCTYPE HTML>
		<html>
			<head> 
				<title> GradedYet </title>
				<link rel='stylesheet' type='text/css' href='./CSS/ClassesStyle.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<script src='script.js'></script>
				<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
			</head>
		";
	}

	private function Body() {
		return "
		<body>
			<div class='header'>
				<div class='headerLogo'>
					<!--<img src='Images/Logo.png' class='logo'>-->
					<div class='logo'></div>
				</div>
				<div class='login'>
					<a href='Login.php'><h2 id='loginH2' class='roboto'>I Am a Teacher</h2></a>
				</div>
			</div>
			<div class='classesGrid'>
            	".$this->ClassesController->GetClasses()."
        	</div>
		</body>
		</html>
		";
	}

	private function Footer() {
		return "";
	}
}
?>