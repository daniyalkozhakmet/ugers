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
    public function get_claims($message = '', $is_deleted = false)
    {
        $this->authorize();
        $req = new \Core\Request;
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;

        if ($req->get('invent') != '') {
            $search = $req->get('invent');
            return $this->search_by_invent($search);
        }
        $claims = $data['claims']->get_my_claims(['is_deleted' => $is_deleted]);
        if (is_string($claims)) {
            $data['error'] = $claims;
            $this->view('myclaims', $data);
            return;
        }

        $data['claims'] = $claims;
        if ($message != '') {
            message($message);
            redirect('claim/get_my_claims');
            $data['info'] = ['type' => 'success'];
        }
        $this->view('myclaims', $data);
    }
    public function get_deleted_claims()
    {
        $this->authorize();
        $this->get_claims('', true);
    }
    public function search_by_invent($search)
    {
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $claims = $data['claims']->get_my_claims(['invent_num' => $search]);
        if (is_string($claims)) {
            $data['error'] = $claims;
            $this->view('myclaims', $data);
            return;
        }

        $data['claims'] = $claims;
        $this->view('myclaims', $data);
        return;
    }
}
