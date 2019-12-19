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
				<link rel='stylesheet' type='text/css' href='./ClassesStyle.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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
            <div class='classesCardsGrid'>
                <div class='classCard'>
                    <div class='topHalveClassCard'>
                        <img src='Images/Maths.png' class='classCardImage'>
                    </div>
                    <div class='bottomHalveClassCard'>
                        <h1 class='classesTitleH1'>Mathmatics</h1>
                        <a href='Maths.php'><p class='classLinkP'>Teacher Progress</p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <div class='topHalveClassCard'>
                        <img src='Images/Geography.png' class='classCardImage'>
                    </div>
                    <div class='bottomHalveClassCard'>
                        <h1 class='classesTitleH1'>Geography</h1>
                        <a href='Geography.php'><p class='classLinkP'>Teacher Progress</p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <div class='topHalveClassCard'>
                        <img src='Images/Programming.png' class='classCardImage'>
                    </div>
                    <div class='bottomHalveClassCard'>
                        <h1 class='classesTitleH1'>Programming</h1>
                        <a href='Programming.php'><p class='classLinkP'>Teacher progress</p></a>
                    </div>
                </div>
                <div class='classCard'>
                    <div class='topHalveClassCard'>
                        <img src='Images/History.png' class='classCardImage'>
                    </div>
                    <div class='bottomHalveClassCard'>
                        <h1 class='classesTitleH1'>History</h1>
                        <a href='History.php'><p class='classLinkP'>Teacher Progress</p></a>
                    </div>
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