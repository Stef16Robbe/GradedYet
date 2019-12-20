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
                <link rel='stylesheet' type='text/css' href='./main.css'>
                <link rel='stylesheet' type='text/css' href='./util.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
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
			<div class='chooseGroup'>
				<h1 id='chooseGroupH1' class='roboto'>Choose your group</h1>
			</div>
			<div class='classGrid'>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF1SA</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF1SB</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF1C</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF1D</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF2SB</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF2SA</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF2SC</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <h1 class='classTitleH1'>INF2D</h1>
                    <div class='viewClassesLink'>
                        <a href='Classes.php'><p class='classLinkP'>View your classes ></p></a>
                </div>
            </div>
        </body
    </html
		";
	}

	private function Footer() {
		return "";
	}
}
?>