<?php 

class DB
{
	
	private $host;
	private $user;
	private $password;
	private $db;
	private $con;

	public function __construct( $host , $user , $password , $db )
	{
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->db = $db;
		$this->con = $this->connection();
		$this->create_table();
	}

	private function connection()
	{
		$con = @new mysqli($this->host , $this->user , $this->password);

		if($con->connect_error)
		{
			die('Connect Error (' . $con->connect_error . ') ');
		}

		if( !$con->query("CREATE DATABASE IF NOT EXISTS {$this->db}"))
		{
			die('Connect Error (' . $con->error . ') ');
		}

		$con->select_db($this->db);

		return $con;
	}

	private function conn_exit(){

		$this->con->exit();

	}

	public function insertTable($data)
	{
		$data['username'] = strip_tags(trim($data['username']));
		$data['surname'] = strip_tags(trim($data['surname']));
		
		if( !$this->con->query("INSERT INTO `peoples` (`username` , `surname` , `age` ) VALUES ('" . $this->con->real_escape_string($data['username']) . "' , '" . $this->con->real_escape_string($data['surname']) . "' , ". $data['age'].")")){
			die($this->con->error);
		}

	}

	private function create_table()
	{
		if( !$this->con->query("CREATE TABLE IF NOT EXISTS `peoples` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `surname` VARCHAR(100) NOT NULL , `age` TINYINT(100) UNSIGNED NOT NULL , INDEX `username_index` (`username`), INDEX `surname_index` (`surname`), UNIQUE (`id`)) ENGINE = INNODB;") ){
			die('Table Error (' . $this->con->error . ')');
		}
	}

	

}