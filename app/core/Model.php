<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * Main Model trait
 */
trait Model
{
	use Database;

	public $limit 		= 10;
	public $offset 		= 0;
	public $order_type 	= "desc";
	public $order_column = "id";
	public $errors 		= [];

	public function findAll()
	{

		$query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

		return $this->query($query);
	}
	public function getAmountOfRecords($col)
	{
		$query = "select COUNT($col) as total_amount from $this->table";
		$data = $this->query($query);
		if (is_bool($data)) {
			return $data;
		}
		return $data[0]->total_amount;
	}
	public function where($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		$query = trim($query, " && ");

		$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);
		return $this->query($query, $data);
	}

	public function first($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		$query = trim($query, " && ");

		$query .= " limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);

		$result = $this->query($query, $data);
		if ($result)
			return $result[0];

		return false;
	}

	public function insert($data)
	{
		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		$this->query($query, $data);

		return false;
	}
	public function match($data, $data_not = [])
	{
		$is_deleted = false;

		//Check if admin wants to filter by all cliams
		if (!is_bool($data['is_deleted'])) {
			unset($data['is_deleted']);
			$keys = array_keys($data);
			$query = "select * from $this->table where ";
			foreach ($keys as $key) {
				$query .= $key . " LIKE '%" . $data[$key] . "%'" . " AND ";
			}

			$query = trim($query, " AND ");

			$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
			$data = array_merge($data, $data_not);
			return $this->query($query);
		}
		//Check if admin wants to filter by deleted or not deleted cliams
		if (isset($data['is_deleted'])) {
			$is_deleted = intval($data['is_deleted']);
			unset($data['is_deleted']);
		}

		$query = "select * from $this->table where ";
		$query .= ' is_deleted = ' . $is_deleted . ' AND ';
		//Check if user wants to filter
		if (isset($data['res'])) {
			if ($data['res'] == 'admin') {
				unset($data['res']);
			} else {
				if ($data['res']  == '') {
					unset($data['res']);
				} else {
					$res = $data['res'];
					$query .= ' res = :' . 'res' . ' AND ';
					unset($data['res']);
				}
			}
		}

		$keys = array_keys($data);
		$query .= '(';
		foreach ($keys as $key) {
			$query .= $key . " LIKE '%" . $data[$key] . "%'" . " OR ";
		}

		$query = trim($query, " OR ");

		$query .= ") order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);
		return $this->query($query, isset($res) ?  ['res' => $res] : []);
	}
	public function update($id, $data, $id_column = 'id')
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
	}

	public function delete($id, $id_column = 'id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

	public function getError($key)
	{
		if (!empty($this->errors[$key]))
			return $this->errors[$key];

		return "";
	}

	protected function getPrimaryKey()
	{

		return $this->primaryKey ?? 'id';
	}

	public function validate($data)
	{

		$this->errors = [];


		if (!empty($this->validationRules)) {
			foreach ($this->validationRules as $column => $rules) {

				if (!isset($data[$column]))
					continue;

				foreach ($rules as $rule) {

					switch ($rule) {
						case 'required':
							if (empty($data[$column]))
								$this->errors[$column] = "Введите " . ucfirst($column);
							break;
						case 'email':

							if (!filter_var(trim($data[$column]), FILTER_VALIDATE_EMAIL))
								$this->errors[$column] = "Invalid email address";
							break;
						case 'numeric_fixed_8':
							if (!preg_match("/^\d{1,10}$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " не должно быть не более 10 чисел";
							break;
						case 'alpha':
							if (!preg_match("/^[a-zA-Z]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters without spaces";
							break;
						case 'alpha_space':
							if (!preg_match("/^[a-zA-Z ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'alpha_numeric':
							if (!preg_match("/^[0-9]+$/", trim($data[$column])))
								$this->errors[$column] = "Должны быть только цифры " . ucfirst($column);
							break;
						case 'alpha_numeric_symbol':
							if (!preg_match("/^[a-zA-Z0-9\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'alpha_symbol':

							if (!preg_match("/^[a-zA-Z\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;

						case 'not_less_than_8_chars':

							if (strlen(trim($data[$column])) < 8)
								$this->errors[$column] = ucfirst($column) . " should not be less than 8 characters";
							break;
						case "date":
							if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'unique':

							$key = $this->getPrimaryKey();
							if (!empty($data[$key])) {
								//edit mode
								if ($this->first([$column => $data[$column]], [$key => $data[$key]])) {
									$this->errors[$column] = ucfirst($column) . " should be unique";
								}
							} else {
								//insert mode
								if ($this->first([$column => $data[$column]])) {
									$this->errors[$column] = ucfirst($column) . " should be unique";
								}
							}
							break;

						default:
							$this->errors['rules'] = "The rule " . $rule . " was not found!";
							break;
					}
				}
			}
		}
		if (empty($this->errors)) {
			return true;
		}

		return false;
	}
}
