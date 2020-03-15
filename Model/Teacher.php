<?php
require_once("Autoloader.php");
class Teacher 
{
    function __construct($id, $name, $prefix, $lastName, $schoolId, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->prefix = $prefix;
        $this->lastName = $lastName;
        $this->schoolId = $schoolId;
        $this->email = $email;
     }

    public $id;
    public $name;
    public $prefix;
    public $lastName;
    public $schoolId;
    public $email;
}
?>