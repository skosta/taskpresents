<?php
class sql{	
	public  $connect = false;
	private $host = "localhost";
	private $user = "userDb";
	private $db = "nameDb";
	private $password = "MyPass";
	private $charset = "utf8";

	public function __construct(){		
		$dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
		$opt = Array(
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		);
		$this->connect = new PDO($dsn, $this->user, $this->password, $opt);
	}
}
?>