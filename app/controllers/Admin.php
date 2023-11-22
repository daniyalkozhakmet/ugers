<?php

namespace Controller;

use Core\Pager;
use Model\User;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * home class
 */
class Admin
{
    use MainController;
    public function authorize()
    {
        $ses = new \Core\Session;
        if (!$ses->is_admin()) {
            redirect('login');
            return false;
        }
        return $ses;
    }
    public function index()
    {
        var_dump('ADMIN');
    }
    public function get_users()
    {
        $this->authorize();
        $user = new User;
        $users = $user->getUsers();
        $this->view('users', $users);
    }
    public function edit()
    {
        $this->authorize();
        $ses = new \Core\Session;
        if (!$ses->is_admin())
            redirect('login');
        $user_id = extractParam('id');
        $req = new \Core\Request;
        if (intval($user_id) == 0) {
            redirect('users');
        }
        $user['user'] = new \Model\User;

        if ($req->posted()) {
            $isUpdated = $user['user']->updateUser($_POST, $user_id);
            if ($isUpdated) {
                $user['message'] = "Password updates";
            } else {
                $user['message'] = "Passwords do not match";
            }
            $user['user'] = $user['user']->getUserById(['id' => $user_id])[0];
            $this->view('user', $user);
            return;
        }

        $user['user'] = $user['user']->getUserById(['id' => $user_id])[0];
        $this->view('user', $user);
    }
}
