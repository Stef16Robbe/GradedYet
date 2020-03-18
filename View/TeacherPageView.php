<?php
session_start();
require_once("Autoloader.php");

class TeacherPageView
{
	private $TeacherPageController;
	private $TeacherPageModel;

	public function __construct($TeacherPageController, $TeacherPageModel) {
		$this->TeacherPageController = $TeacherPageController;
		$this->TeacherPageModel = $TeacherPageModel;
	}

	public function output() {
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
                <link rel='stylesheet' type='text/css' href='./CSS/TeacherPageStyle.css'>
				<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
			</head>
		";
	}

	private function Body() {
		return "
			<body>
				<div class='classGrid'>
					".$this->TeacherPageController->GetGroups()."
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