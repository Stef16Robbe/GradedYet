<?php
require_once( "Autoloader.php");
class RegisterController 
{
	private $RegisterModel;
    private $Config;
    private $DB_Helper;

	public function __construct($RegisterModel) {
		$this->RegisterModel = $RegisterModel;
        $this->Config = Config::getInstance();
        $this->DB_Helper = new DB_Helper();
	}
	
	// get config
	public function GetConfig() {
		return $this->Config;
    }
    
    public function RegisterTeacher() {
        try {
			$this->Register();
		} catch (Exception $e) {
			// fill the message with an error if something goes wrong.
			return $e->GetMessage();
		}
    }

    public function GetExistingSchools() {
        $existingSchools = $this->DB_Helper->GetSchools();
        $schools = "";
        foreach ($existingSchools as $existingSchool) {
            $schools .= "<option class='schools' value='".$existingSchool."'";
        }
        return $schools;
    }

    private function Register() {
        if (isset($_POST["RegisterTeacherBtn"])) {
            $school = $_POST["RegisterTeacherSchool"];
            $name = $_POST["RegisterTeacherName"];
            if (isset($_POST["RegisterTeacherPrefix"])) {
                $prefix = $_POST["RegisterTeacherPrefix"];
            } else {
                $prefix = "";
            }
            $lastName = $_POST["RegisterTeacherLastName"];
            $email = $_POST["RegisterTeacherEmail"];
            $password = hash('sha512', $_POST["RegisterTeacherPassword"]);

            if ($schoolId = $this->DB_Helper->CheckSchool($school)) {
                if (!$this->DB_Helper->CheckEmail($email)) {
                    if ($this->DB_Helper->RegisterTeacher($schoolId, $name, $prefix, $lastName, $email, $password)) {
                        header("Location: Login.php");
                    } else {
                        throw new Exception("Something went wrong. Your account has not been registered. Please try again later.");
                    }
                } else {
                    throw new Exception("This Email has already been registered.");
                }
            }
        }
    }
}

?>