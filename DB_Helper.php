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

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Insert
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function RegisterUser($email, $name, $password) {
		// clean email and password
		$cleanEmail = mysqli_real_escape_string($this->Conn, $email);
		$cleanPassword = mysqli_real_escape_string($this->Conn, $password);
		$cleanName = mysqli_real_escape_string($this->Conn, $name);

		// does prepared query
		$stmt = $this->Conn->prepare("INSERT INTO Teachers (Email, Name) VALUES(?, ?)");
		$stmt->bind_param("ss", $cleanEmail, $cleanPassword);

		// commit or rollback transaction
		if ($stmt->execute()) {
			$this->Conn->commit();
			return true;
		} else {
			$this->Conn->rollback();
			return false;
		} 
	}

	private function RegisterUserPsw($cleanPassword) {
		// does a prepared query
		$stmt = $this->Conn->prepare("INSERT INTO passwords (TeacherId, Password) VALUES((SELECT Id FROM teachers ORDER BY Id DESC LIMIT 1), ?)");
		$stmt->bind_param("s", $cleanPassword);
		
		//Commit or rollback transaction 
		if ($stmt->execute()) {
			$this->Conn->commit();
		} else {
			$this->Conn->rollback();
			throw new Exception("Error: " . $sql . "<br>" . $this->Conn->error);
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