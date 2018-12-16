<?php
require_once('database.php');
class CrudOperation extends Database{
	// select all records method
	public function select_all($table){
		$sql="";
		$array = array();
		$sql = "SELECT * FROM ".$table;
		$query = mysqli_query($this->con, $sql);
		while($row = mysqli_fetch_assoc($query)):
			$array[] = $row;
		endwhile;
		return $array;
	}

	// select record where id = ''
	public function select_where($table, $where){
		$sql = "";
		$array = array();
		$condition="";
		foreach ($where as $key => $value) {
			$condition .= $key.="='".$value."'";
		}
		$sql = "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)):
			$array[]=$row;
		endwhile;
		return $array;
	}

	// Insert Method
	public function insert($table, $data){
		$sql = "";
		$sql .="INSERT INTO ".$table." (".implode(", ", array_keys($data)).") VALUES ('".implode("','", array_values($data))."')";
		$query = mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
	}

	// Update Method
	public function update($table, $data, $where){
		$sql ="";
		$condition="";
		foreach ($where as $key => $value) {
			$condition .= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0, -5);

		foreach ($data as $key => $value) {
			$sql .= $key."='".$value."', ";
		}
		$sql .= substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		$query = mysqli_query($this->con, $sql);
		if ($query) {
			return true;
		}
	}
}
$obj = new CrudOperation;