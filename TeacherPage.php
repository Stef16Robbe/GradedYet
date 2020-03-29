<?php
	// start when page loads
	require_once("Autoloader.php");
	$TeacherPageModel = new TeacherPageModel();
	$TeacherPageController = new TeacherPageController($TeacherPageModel);
	$view = new TeacherPageView($TeacherPageController, $TeacherPageModel);
	echo $view->output();
?>