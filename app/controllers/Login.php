<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * login class
 */
class Login
{
	use MainController;

	public function index()
	{
		$ses = new \Core\Session;
		if ($ses->is_logged_in())
			redirect('claim/get_my_claims');

		$data['user'] = new \Model\User;
		$req = new \Core\Request;
		if ($req->posted()) {
			$data['user']->login($_POST);
		}
		$this->view('login', $data);
	}
}
