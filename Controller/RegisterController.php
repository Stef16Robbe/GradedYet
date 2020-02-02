<?php
require_once( "Autoloader.php");
class RegisterController 
{
	private $RegisterModel;
	private $Session;
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
            $schools .= "<option value='".$existingSchool."'";
        }
        return $schools;
    }

    private function Register() {
        if (isset($_POST["RegisterTeacherBtn"])) {
            $email = $_POST["RegisterTeacherEmail"];
            $password = $_POST["RegisterTeacherPassword"];

            if ($this->CheckEmail($email)) {
                if ($this->CheckPassword($password)) {
                    $password = hash('sha512', $password);
                    if ($this->DB_Helper->RegisterUser($email, $password)) {
                        header("Location: TeacherPage.php");
                    } else {
                        throw new Exception("Something went wrong. Your account has not been registered. Please try again.");
                    }
                } else {
                    throw new Exception("Invalid password.");
                }
            } else {
                throw new Exception("Invalid Email. Only Teachers can register a Teacher account.");
            }
        }
    }

    private function CheckEmail($email) {
        if (preg_match('/[a-zA-Z]@inholland.nl/', $email)) {
            return true;
        } else {
            return false;
        }
    }

    private function CheckPassword($password) {
        if (preg_match('/^(?=[a-z])(?=[A-Z])[a-zA-Z]{8,}$/', $password)) {
            return true;
        } else {
            return false;
        }
    }
}

?>