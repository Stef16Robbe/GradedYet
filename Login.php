<?php
	// start when page load
	require_once("Autoloader.php");
	$LoginModel = new LoginModel();
	$LoginController = new LoginController($LoginModel);
	$view = new LoginView($LoginController, $LoginModel);
	echo $view->output();
?>