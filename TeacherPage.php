<?php
	//start when page load
	require_once("Autoloader.php");
	$TeacherPageModel = new TeacherPageModel();
	$TeacherPageController = new TeacherPageController($TeacherPageModel);
	$view = new TeacherPageView($TeacherPageController, $TeacherPageModel);
	echo $view->output();
?>