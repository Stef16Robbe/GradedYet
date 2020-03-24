<?php
	//start when page load
	require_once("Autoloader.php");
	$ClassesModel = new ClassesModel(0, 0, "", "", 0, 0);
	$ClassesController = new ClassesController($ClassesModel);
	$view = new ClassesView($ClassesController, $ClassesModel);
	echo $view->output();
?>