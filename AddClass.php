<?php
session_start();
require_once("Autoloader.php");
if (isset($_POST["submitNewClass"]) && isset($_POST["groupName"]) && isset($_POST["className"]) && isset($_POST["totalTests"])) {
    if ($_POST["groupName"] != null && $_POST["className"] != null && $_POST["totalTests"] != null) {
        $DB_Helper = new DB_Helper();
        $encryptionHelper = new EncryptionHelper();
        $testAmount = (int)$_POST["totalTests"];
        $teacherId = $encryptionHelper->Decrypt($_SESSION["teacherId"]);
        $DB_Helper->AddNewClass($_POST["groupName"], $_POST["className"], $testAmount, $teacherId);
    }
}
header("Location: TeacherPage.php");
?>