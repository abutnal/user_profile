<?php
class Database{
	public $con;
	public function __construct(){
		$this->con = mysqli_connect("localhost", "root", "", "userprofile");
		if (!$this->con) {
			die('Falied to connect DB').mysqli_error();		
		}
	}
}
$obj = new Database;