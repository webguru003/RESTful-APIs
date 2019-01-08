<?php 
class Db {
	private $host = 'localhost';
	private $dbname = 'phpapis';
	private $username = 'root';
	private $password = '';
	private $conn;

	public function connect() {
		$this->conn = null;
		try {
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $errormsg) {
			echo 'Error while connecting to DB : '. $errormsg->getMessage();
		}
		return $this->conn;
	}
}
?>