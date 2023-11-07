<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

trait Database
{

	private function connect()
	{
		$string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
		$con = new \PDO($string, DBUSER, DBPASS);
		return $con;
	}

	public function createUserTable()
	{
		$con = $this->connect();
		$users = "CREATE TABLE IF NOT EXISTS users (
			id INT AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(50) NOT NULL,
			password VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		);";
		$roles = "CREATE TABLE IF NOT EXISTS roles (
			id SERIAL PRIMARY KEY,
			role_name VARCHAR(50) UNIQUE NOT NULL
		);";
		$user_role = "CREATE TABLE IF NOT EXISTS user_role (
			user_id INT REFERENCES users(user_id),
			role_id INT REFERENCES roles(role_id),
			PRIMARY KEY (user_id, role_id)
		);";
		$statements = [$users, $roles, $user_role];
		try {
			//code...
			foreach ($statements as $statement) {
				$con->exec($statement);
			}
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function query($query, $data = [])
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if ($check) {
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				return $result;
			}
		}

		return false;
	}

	public function get_row($query, $data = [])
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if ($check) {
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				return $result[0];
			}
		}

		return false;
	}
}
