<?php
require_once("Autoloader.php");
    if (isset($_POST["id"])) {
        $DB_Helper = new DB_Helper();
        if ($DB_Helper->DeleteClass($_POST["id"])) {
            print 1;
        } else {
            print 0;
        }
    }
?>