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
				<div class='login'>
					<p id='loginP' class='roboto'>I Am a Teacher</p>
				</div>
			</div>

		</body>
		";
	}

	private function Footer() {
		return "";
	}
}
?>