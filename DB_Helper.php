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

	public function CheckTeacherCredentials($email, $password) {
		// clean user input
		$cleanEmail = $this->CleanValue($email);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT Id, `Name`, Prefix, LastName, SchoolId FROM `teacher` WHERE `Email` LIKE ?");
		$stmt->bind_param("s", $cleanEmail);
		$stmt->execute();
		$stmt->store_result();
		if ($this->CheckTeacherPsw($password)) {
			if ($stmt->num_rows == 0) {
				return false;
			} else {
				$stmt->bind_result($Id, $Name, $Prefix, $LastName, $SchoolId);
				while ($stmt->fetch()) {
					$teacher = new Teacher($Id, $Name, $Prefix, $LastName, $SchoolId, $cleanEmail);
				}
				return $teacher;
			}
		}
	}

	private function CheckTeacherPsw($password) {
		// does prepared query
		$stmt = $this->Conn->prepare("SELECT Id FROM teacherlogin WHERE `Password` LIKE ?");
		$stmt->bind_param("s", $password);
		$stmt->execute();
		$stmt->store_result();
		
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function GetClasses($groupName) {
		// clean user input
		$cleanGroupName = $this->CleanValue($groupName);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT Id, `Name`, TestAmount, ExaminedAmount, TeacherId FROM class WHERE `Group` LIKE ?");
		$stmt->bind_param("s", $cleanGroupName);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Id, $Name, $TestAmount, $ExaminedAmount, $TeacherId);
			$classes = array();
			while ($stmt->fetch()) {
				$class = new ClassesModel($Id, $TeacherId, $Name, $cleanGroupName, $TestAmount, $ExaminedAmount);
				$classes[] = $class;
			}
			return $classes;
		}
	}

	public function GetTeacherClasses($groupName, $teacherId) {
		// clean user input
		$cleanGroupName = $this->CleanValue($groupName);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT Id, `Name`, TestAmount, ExaminedAmount, TeacherId FROM class WHERE `Group` LIKE ? AND TeacherId LIKE ?");
		$stmt->bind_param("si", $cleanGroupName, $teacherId);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Id, $Name, $TestAmount, $ExaminedAmount, $TeacherId);
			$classes = array();
			while ($stmt->fetch()) {
				$class = new ClassesModel($Id, $TeacherId, $Name, $cleanGroupName, $TestAmount, $ExaminedAmount);
				$classes[] = $class;
			}
			return $classes;
		}
	}

	public function GetAllGroups() {
		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT DISTINCT `Group` FROM class");
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Group);
			$groups = array();
			while ($stmt->fetch()) {
				$group = array("Name"=>$Group);
				$groups[] = $group;
			}
			return $groups;
		}
	}

	public function GetGroups($teacherId) {
		// clean user input
		$cleanId = $this->CleanValue($teacherId);

		// does a prepared query
		$stmt = $this->Conn->prepare("SELECT `Group`, Id FROM class WHERE TeacherId LIKE ?");
		$stmt->bind_param("i", $cleanId);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			return false;
		} else {
			$stmt->bind_result($Group, $Id);
			$groups = array();
			while ($stmt->fetch()) {
				$group = array("Name"=>$Group, "Id"=>$Id);
				$groups[] = $group;
			}
			return $groups;
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Insert
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function RegisterTeacher($teacher, $password) {
		// clean user input
		$cleanName = $this->CleanValue($teacher->name);
		$cleanPrefix = $this->CleanValue($teacher->prefix);
		$cleanLastName = $this->CleanValue($teacher->lastName);
		$cleanEmail = $this->CleanValue($teacher->email);
		$cleanPassword = $this->CleanValue($password);

		// does prepared query
		$stmt = $this->Conn->prepare("INSERT INTO teacher (Name, Prefix, LastName, SchoolId, Email) VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $cleanName, $cleanPrefix, $cleanLastName, $teacher->schoolId, $cleanEmail);

		// commit or rollback transaction
		if ($this->SetTeacherPsw($cleanPassword)) {
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
		// does a prepared query
		$stmt = $this->Conn->prepare("INSERT INTO teacherlogin (Password) VALUES(?)");
		$stmt->bind_param("s", $password);
		
		// commit or rollback transaction 
		if ($stmt->execute()) {
			$this->Conn->commit();
			return true;
		} else {
			$this->Conn->rollback();
			return false;
		}
	}

	public function AddNewClass($groupName, $className, $totalTests, $teacherId) {
		// clean user input
		$cleanClassName = $this->CleanValue($className);
		$cleanTestAmount = $this->CleanValue($totalTests);
		$cleanGroupName = $this->CleanValue($groupName);
		$cleanExaminedAmount = 0;

		// does a prepared query
		$stmt = $this->Conn->prepare("INSERT INTO class (Name, TestAmount, ExaminedAmount, `Group`, TeacherId) VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("siisi", $cleanClassName, $cleanTestAmount, $cleanExaminedAmount, $cleanGroupName, $teacherId);
		
		// commit or rollback transaction 
		if ($stmt->execute()) {
			$this->Conn->commit();
			return true;
		} else {
			$this->Conn->rollback();
			return false;
		}
	}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Update
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function UpdateExaminedAmount($id, $examinedAmount) {
		$cleanId = $this->CleanValue($id);
		$cleanExaminedAmount = $this->CleanValue($examinedAmount);

		$stmt = $this->Conn->prepare("UPDATE class SET ExaminedAmount = ? WHERE Id = ?");
		$stmt->bind_param("ii", $cleanExaminedAmount, $cleanId);
		if ($stmt->execute()) {
			$this->Conn->commit();
			return true;
		} else {
			$this->Conn->rollback();
			return false;
		}
	}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Delete
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function DeleteClass($id) {
		$cleanId = $this->CleanValue($id);
		
		$stmt = $this->Conn->prepare("DELETE FROM class WHERE Id = ?");
		$stmt->bind_param("i", $cleanId);
		if ($stmt->execute()) {
			$this->Conn->commit();
			return true;
		} else {
			$this->Conn->rollback();
			return false;
		}
	}


}
?>