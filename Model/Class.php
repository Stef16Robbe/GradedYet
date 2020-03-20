<?php
require_once("Autoloader.php");
class ClassesModel
{
	function __construct($id, $teacherId, $name, $group, $amount, $examinedAmount) {
		$this->id = $id;
		$this->teacherId = $teacherId;
        $this->name = $name;
        $this->group = $group;
        $this->amount = $amount;
        $this->examinedAmount = $examinedAmount;
    }

	public $id;
	public $teacherId;
    public $name;
    public $group;
    public $amount;
    public $examinedAmount;
}
?>