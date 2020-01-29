<?php
	// start when page load
	require_once("Autoloader.php");
	$RegisterModel = new RegisterModel();
	$RegisterController = new RegisterController($RegisterModel);
	$view = new RegisterView($RegisterController, $RegisterModel);
	echo $view->output();
?>