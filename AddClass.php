<?php
session_start();
require_once("Autoloader.php");
if (isset($_POST["submitNewClass"]) && isset($_POST["groupName"]) && isset($_POST["className"]) && isset($_POST["totalTests"])) {
    $testAmount = (int)$_POST["totalTests"];
    $teacherId = $_SESSION["teacherId"];
    $DB_Helper = new DB_Helper();
    $DB_Helper->AddNewClass($_POST["groupName"], $_POST["className"], $testAmount, $teacherId);
}
header("Location: TeacherPage.php");
?>