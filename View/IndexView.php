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
                <link rel='stylesheet' type='text/css' href='./CSS/IndexStyle.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
			</head>
		";
	}

	private function Body() {
		return "
		<body>
			<div class='header'>
                <div class='headerLogo'>
                    <a href='index.php'>
                        <i style='font-size:50px' class='material-icons'>&#xe88a;</i>
                    </a>    
				</div>
				<div class='login'>
					<a href='Login.php'><h2 id='loginH2' class='roboto'>I Am a Teacher</h2></a>
				</div>
			</div>
			<div class='chooseGroup'>
				<h1 id='chooseGroupH1' class='roboto'>Choose your group</h1>
			</div>
			<div class='classGrid'>
                ".$this->IndexController->GetAllGroups()."
            </div>
        </body
    </html>
		";
	}

	private function Footer() {
		return "";
	}
}
?>