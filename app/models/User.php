<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * User class
 */
class User
{

	use Model;

	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $loginUniqueColumn = 'username';

	protected $allowedColumns = [
		'username',
		'password',
		'role_name',
		'role_id',
		'user_id'
	];

	/*****************************
	 * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
	 * 
	 ****************************/
	protected $validationRules = [

		'username' => [
			'alpha',
			'required',
		],
		'password' => [
			'not_less_than_8_chars',
			'required',
		],
	];

	public function signup($data)
	{
		if ($this->validate($data)) {
			//add extra user columns here
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['date'] = date("Y-m-d H:i:s");
			$data['date_created'] = date("Y-m-d H:i:s");

			$this->insert($data);
			redirect('login');
		}
	}

	public function login($data)
	{
		$row = $this->first([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);

		if ($row) {

			//confirm password
			if (password_verify($data['password'], $row->password)) {
				$ses = new \Core\Session;
				$ses->auth($row);
				redirect('home');
			} else {
				$this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
			}
		} else {
			$this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
		}
	}
	public function seedUserRoles()
	{

		$this->seedUsers();
		$this->seedRoles();
		$this->seedPivotTable();
	}
	public function seedRoles()
	{
		$roles = [
			["role_name" => 'user'],
			["role_name" => 'admin'],
		];
		try {
			$this->table = 'roles';
			if ($this->getAmountOfRecords("id") == 0) {
				foreach ($roles as $data) {
					$this->insert($data);
				}
			}
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}
	public function seedUsers()
	{
		$users = [
			[
				"username" => 'res1',
				"password" => 'User2023!',
			],
			[
				"username" => 'res2',
				"password" => 'User2023!',
			],
			[
				"username" => 'res3',
				"password" => 'User2023!',
			],
			[
				"username" => 'res4',
				"password" => 'User2023!',
			],
			[
				"username" => 'res5',
				"password" => 'User2023!',
			],
			[
				"username" => 'res6',
				"password" => 'User2023!',
			],
			[
				"username" => 'res7',
				"password" => 'User2023!',
			],
		];
		try {
			$this->table = 'users';
			if ($this->getAmountOfRecords("id") == 0) {
				foreach ($users as $data) {
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					$data['date'] = date("Y-m-d H:i:s");
					$data['date_created'] = date("Y-m-d H:i:s");
					$this->insert($data);
				}
			}

			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}
	public function seedPivotTable()
	{;
		$this->table = 'roles';
		$roles = $this->where(['role_name' => 'user'])[0];
		$this->table = 'users';
		$users = $this->findAll();


		$this->table = 'user_role';
		if ($this->getAmountOfRecords("user_id") == 0) {
			foreach ($users as $user) {
				var_dump([['user_id' => $user->id], ['role_id' => $roles->id]]);
				$this->insert([['user_id' => $user->id], ['role_id' => $roles->id]]);
			}
			// $this->insert($data);
		}
	}
}
