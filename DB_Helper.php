<?php
class DB_Helper
{
	private $Conn;
	
	function __construct() {
		$DBConnection = DBConnection::getInstance();
		$this->Conn = $DBConnection->getConnection();

		if ($this->Conn->connect_error) {
			die("Connection failed:" . $this->Conn->connect_error);
		}

		// switch off auto commit to allow transactions
		$this->Conn->autocommit(FALSE);
	}

	public function GetConn(){
		return $this->Conn;
	}

	// 'cleans' any value it's given from any sqsl injection and returns it
	private function CleanValue($value) {
		return mysqli_real_escape_string($this->Conn, $value);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Select
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function GetSchools() {
		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT `Name` FROM `school`");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($Name); 
		$schools = array();
		while ($stmt -> fetch()) {
			$schools[] = $Name;
		}
		return $schools;
	}

	public function CheckSchool($school) {
		// clean user input
		$cleanSchool = $this->CleanValue($school);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT `Id` FROM `school` WHERE `Name` LIKE ?");
		$stmt->bind_param("s", $cleanSchool);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Id);
			while ($stmt->fetch()) {
				$id = $Id;			
			}
			return $id;
		}
	}

	public function CheckEmail($email) {
		// clean user input
		$cleanEmail = $this->CleanValue($email);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT `Id` FROM `teacher` WHERE `Email` LIKE ?");
		$stmt->bind_param("s", $cleanEmail);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function CheckTeacherCredentials($teacher) {
		// clean user input
		$teacher->email = $this->CleanValue($teacher->email);
		$teacher->password = $this->CleanValue($teacher->password);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT Id, Name, Prefix, LastName, SchoolId FROM `teacher` WHERE `Email` LIKE ? AND `Password` LIKE ?");
		$stmt->bind_param("ss", $teacher->password, $teacher->password);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Id, $Name, $Prefix, $LastName, $SchoolId);
			while ($stmt->fetch()) {
				$teacher->id = $Id;
				$teacher->name = $Name;
				$teacher->prefix = $Prefix;
				$teacher->lastName = $LastName;
				$teacher->schoolId = $SchoolId;	
			}
			return $teacher;
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Insert
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function RegisterTeacher($schoolId, $name, $prefix, $lastName, $email, $password) {
		// clean user input
		$cleanName = $this->CleanValue($name);
		$cleanPrefix = $this->CleanValue($prefix);
		$cleanLastName = $this->CleanValue($lastName);
		$cleanEmail = $this->CleanValue($email);

		// does prepared query
		$stmt = $this->Conn->prepare("INSERT INTO teacher (Name, Prefix, LastName, SchoolId, Email) VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $cleanName, $cleanPrefix, $cleanLastName, $schoolId, $cleanEmail);

		// commit or rollback transaction
		if ($this->SetTeacherPsw($password)) {
			if ($stmt->execute()) {
				$this->Conn->commit();
				return true;
			} else {
				$this->Conn->rollback();
				return false;
			}
		}
	}

	private function SetTeacherPsw($password) {
		// clean user input
		$cleanPassword = $this->CleanValue($password);

		// does a prepared query
		$stmt = $this->Conn->prepare("INSERT INTO teacherlogin (Password) VALUES(?)");
		$stmt->bind_param("s", $cleanPassword);
		
		// commit or rollback transaction 
		if ($stmt->execute()) {
			$this->Conn->commit();
		} else {
			$this->Conn->rollback();
			return false;
		}
	}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Update
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Delete
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
?>