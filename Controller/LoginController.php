<?php
require_once( "Autoloader.php");
class LoginController 
{
	private $LoginModel;
	private $Session;
	private $Config;
	private $DB_Helper;
	private $encryptionHelper;
	private $teacher;

	public function __construct($LoginModel){
		$this->IndexModel = $LoginModel;
		$this->Config = Config::getInstance();
		$this->DB_Helper = new DB_Helper();
		$this->encryptionHelper = new EncryptionHelper();
		$this->teacher = new Teacher();
	}
	
	// get config
	public function GetConfig(){
		return $this->Config;
	}

	public function LoginTeacher() {
        try {
			$this->Login();
		} catch (Exception $e) {
			// fill the message with an error if something goes wrong.
			return $e->GetMessage();
		}
	}

	public function CheckCookie() {
        if (isset($_COOKIE['rememberTeacher'])) { 
            return $_COOKIE['rememberTeacher'];
        } else {
            return "";
        }
    }
	
	private function Login() {
		if (isset($_POST["loginBtn"])) {
			$this->teacher->email = $_POST["email"];
			$this->teacher->password = hash('sha512', $_POST["password"]);
			if ($this->teacher = $this->DB_Helper->CheckTeacherCredentials($teacher)) {
				$this->SetSession();
				$this->SetCookie();
				header("Location: TeacherPage.php");
			} else {
				throw new Exception("Invalid credentials.");
			}
		}
	}

	private function SetSession() {
		// encrypt id and set it in session, teacher is logged in
		$_SESSION["userId"] = $this->encryptionHelper->Encrypt($this->teacher->id);
	}

	private function SetCookie() {
		// set cookie remembering teacher email if the "remember me" checkbox has been checked upon login
		if (isset($_POST["rememberPasswordCheck"])) {
			setcookie("rememberTeacher", $this->teacher->email, time() + (86400 * 30), "/");
		}
	}
}

?>