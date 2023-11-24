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
        $this->get_users();
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
    public function claim_view_by_user($invent_num = '')
    {
        $this->authorize();
        $ses = new \Core\Session;
        $req = new \Core\Request;
        if (!$ses->is_admin())
            redirect('login');
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $user_id = $req->get('id');
        $invent_num = $req->get('invent');

        if ($user_id == '' || intval($user_id)  == 0) {
            return redirect('admin/get_users');
        }
        if ($invent_num != '') {
            $claims = $data['claims']->match(['invent_num' => $invent_num]);
        } else {
            $claims = $data['claims']->get_my_claims(['user_id' => $user_id]);
        }


        if (is_string($claims)) {
            $data['error'] = $claims;
            $this->view('myclaims', $data);
            return;
        }

        $data['claims'] = $claims;
        $data['user_id'] = $user_id;
        $this->view('myclaims', $data);
    }
    public function get_my_deleted_claims($message = '')
    {
        $ses = $this->authorize();
        $req = new \Core\Request;
        $username = $ses->user('username');
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $data['is_deleted'] = true;
        if ($req->get('invent') != '') {
            $search = $req->get('invent');
            return $this->search_by_invent($search, true);
        }
        if ($username == 'admin') {
            $claims = $data['claims']->get_my_claims(['is_deleted' => true]);
        } else {
            $claims = $data['claims']->get_my_claims(['res' => $username, 'is_deleted' => true]);
        }


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
    public function search_by_invent($search, $is_deleted = false)
    {
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $data['is_deleted'] = $is_deleted;
        $claims = $data['claims']->search(['invent_num' => $search, 'is_deleted' => $is_deleted]);

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
