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
		'role',
		'role_id',
		'user_id'
	];
	public $info;

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
				redirect('claim/get_my_claims');
			} else {
				$this->errors[$this->loginUniqueColumn] = "Неправильное имя пользователя или пароль";
			}
		} else {
			$this->errors[$this->loginUniqueColumn] = "Неправильное имя пользователя или пароль";
		}
	}
	public function getUsers()
	{
		$users = $this->findAll();
		if (is_bool($users)) {
			return ['error' => 'Не удалось найти'];
		}
		return $users;
	}
	public function getUserById($data)
	{
		$user = $this->first(['id' => $data["id"]]);
		if (is_bool($user)) {
			return ['error' => 'Пользователь с таким идентификатором не найден'];
		}
		return [$user];
	}
	public function updateUser($data, $id)
	{
		if ($data['password'] == $data['password_confirmation']) {
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$this->update($id, $data);
			return true;
		} else {
			return false;
		}
	}

	public function seedUsers()
	{
		$users = [
			[
				"username" => 'res1',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res2',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res3',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res4',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res5',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res6',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'res7',
				"password" => 'User2023!',
				"role" => 'user'
			],
			[
				"username" => 'admin',
				"password" => 'admin',
				"role" => 'admin'
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
}
