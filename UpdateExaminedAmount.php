<?php
require_once("Autoloader.php");
if (isset($_POST['id']) && isset($_POST['finishedAmount'])) {
    $DB_Helper = new DB_Helper();
    if (!$this->DB_Helper->UpdateExaminedAmount($_POST['id'], $_POST['finishedAmount'])) {
        print 0;
    } else {
        print 1;
    }
}
?>