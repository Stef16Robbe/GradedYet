<?php
require_once("Autoloader.php");
if (isset($_POST['saveExaminedAmount']) && isset($_POST['examinedAmount']) && $_POST["examinedAmount"] != NULL && isset($_POST["totalAmount"]) && isset($_POST["id"]) && isset($_POST["groupName"])) {
    $examinedAmount = $_POST["examinedAmount"];
    $totalAmount = $_POST["totalAmount"];
    $id = $_POST["id"];
    $groupName = $_POST["groupName"];
    $DB_Helper = new DB_Helper();
    if ($examinedAmount >= 0 && $examinedAmount <= $totalAmount) {
        if ($DB_Helper->UpdateExaminedAmount($id, $examinedAmount)) {
            header("Location: Classes.php?groupName=".$groupName);
        } else {
            header("Location: Classes.php?groupName=".$groupName);
        }
    } else {
        header("Location: Classes.php?groupName=".$groupName);
    }
} else {
    header("Location: Classes.php?groupName=".$groupName);
}
?>