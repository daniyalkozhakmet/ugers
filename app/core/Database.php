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

	public function createTables()
	{
		$con = $this->connect();
		$users = "CREATE TABLE IF NOT EXISTS users (
			id INT AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(50) NOT NULL,
			password VARCHAR(255) NOT NULL,
			role VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		);";
		$claims = "CREATE TABLE IF NOT EXISTS claims (
			id INT PRIMARY KEY AUTO_INCREMENT,
			neighborhood VARCHAR(50) NOT NULL,
			invent_num VARCHAR(50) NOT NULL,
			address TEXT NOT NULL,
			direction TEXT NOT NULL,
			res VARCHAR(50) NOT NULL,
			date_of_excavation DATE NOT NULL,
			open_square VARCHAR(50) NOT NULL,
			date_recovery_ABP DATE NOT NULL,
			square_restored_area VARCHAR(50) NOT NULL,
			street_type VARCHAR(50) NOT NULL,
			type_of_work VARCHAR(50) NOT NULL,
			is_deleted BOOLEAN DEFAULT false,
			deleted_at TIMESTAMP,
			image1 VARCHAR(255),
			image2 VARCHAR(255),
			image3 VARCHAR(255),
			image5 VARCHAR(255),
			image6 VARCHAR(255),
			claim_photo VARCHAR(255),
			date_of_sign DATE NOT NULL,
			date_of_sending DATE NOT NULL,
			date_of_fixing DATE NOT NULL,
			user_id INT,
			FOREIGN KEY (user_id) REFERENCES users(id),
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

		);";
		$statements = [$users, $claims];
		try {
			//code...
			foreach ($statements as $statement) {
				$con->exec($statement);
			}
			return true;
		} catch (\Throwable $th) {
			var_dump($th);
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
