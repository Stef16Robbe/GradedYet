<?php 
require_once("Autoloader.php");

class IndexView
{
	private $IndexController;
	private $IndexModel;

	public function __construct($indexController, $indexModel)
	{
		$this->IndexController = $indexController;
		$this->IndexModel = $indexModel;
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
				<link rel='stylesheet' type='text/css' href='./IndexStyle.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
			</head>
		</html>
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
			<div class='chooseGroup'>
				<h1 id='chooseGroupH1' class='roboto'>Choose your group</h1>
			</div>

		</body>
		";
	}

	private function Footer() {
		return "";
	}
}
?>