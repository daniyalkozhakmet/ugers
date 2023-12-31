<?php


namespace Controller;

require(__DIR__ . '/../../vendor/autoload.php');

use Core\Pager;
use Model\Image;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * login class
 */
class Claim
{
    use MainController;
    // Check if it is logged in
    public function authorize_user()
    {
        $ses = new \Core\Session;
        if ($ses->is_user()) {
            return $ses;
        } else {
            if (!$ses->is_admin()) {
                redirect('login');
                return false;
            }
            return $ses;
        }
    }

    //Check if user can edit his cliams
    public function authorize_user_can_edit()
    {
        $ses = $this->authorize_user();
        $req = new \Core\Request;
        $data['claim'] = new \Model\Claim;
        $data['error'] = '';
        $username = $ses->user('username');
        $claim_id = $req->get('id');
        if ($claim_id == '') {
            return redirect('claim/get_my_claims');
        }


        $claim = $data['claim']->get_single_claim(['id' => $claim_id]);
        if (is_string($claim)) {
            $data['error'] = $claim;
        } else {
            if ($claim->res == $username || $username == 'admin') {
                $data['data'] = $claim;
                return $data;
            }
        }
        return redirect('claim/get_my_claims');
    }
    //Shows 404 page
    public function index()
    {
        $ses = $this->authorize_user();
        $this->view('404');
    }
    //Get single cliam
    public function single()
    {
        $data = $this->authorize_user_can_edit();
        $this->view('single', $data);
    }
    //Creates new cliam
    public function create()
    {
        $ses = $this->authorize_user();
        if ($ses->is_admin()) {
            return redirect('claim/get_my_claims');
        }
        $req = new \Core\Request;
        $data['claim'] = new \Model\Claim;
        if ($req->posted()) {
            $new_claim = $req->post();
            $new_claim += array('res' => $ses->user('username'));
            $new_claim += array('user_id' => $ses->user('id'));
            $files = $req->files();
            $images_name = ['image1', 'image2', 'image3'];
            $image_AWS = [];
            $image_err = [];
            $check_before_image = $data['claim']->validate($new_claim);
            if ($check_before_image) {
                foreach ($images_name as $image_name) {
                    if (!empty($files[$image_name]['name'])) {
                        $image_AWS = $this->upload($files, $image_name);
                        if (isset($image_AWS['errors']) &&  count($image_AWS['errors']) > 0) {

                            foreach ($image_AWS['errors'] as $key => $value) {
                                $newArray[$key] = $value;
                                $image_err += array($key => $value);
                            }
                        } else {
                            if ($image_AWS['status'] == 'error') {

                                $data['claim']->errors += $image_AWS['message'];
                            } else {
                                $new_claim += array($image_name => $image_AWS['link']);
                            }
                        }
                    }
                }
            }



            $data['claim']->create($new_claim);
            $data['claim']->errors += $image_err;
            if (count($data['claim']->errors) == 0) {
                $this->get_my_claims('Заявка создана успешно');
            }
        }
        $this->view('create', $data);
    }
    //Upload file
    public function upload($files, $image_name)
    {

        $folder = 'uploads/';
        $s3 = new AWS();
        // if (!file_exists($folder)) {
        //     mkdir($folder, 0777, true);
        //     file_put_contents($folder, 'index.php', "");
        // }
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (in_array($files[$image_name]['type'], $allowed)) {
            $new_claim[$image_name] = $folder . time() . rand(0, 1000) . $files[$image_name]['name'];
            $response = $s3->putObject($files[$image_name]['tmp_name'], $new_claim[$image_name], $files[$image_name]['type']);
            // move_uploaded_file($files[$image_name]['tmp_name'], $new_claim[$image_name]);
            // $image = new Image;
            // $image->resize($new_claim[$image_name], 1000);
            return $response;
        } else {
            $response['errors'] = [];
            $response['errors'] += array($image_name => 'Тип файла не поддерживается');
            return $response;
        }
    }
    //Deletes replaced image
    public function deleteImage($image_name)
    {
        $s3 = new AWS();
        $s3->deleteObject($image_name);
    }
    //Get cliams by user
    public function get_my_claims($message = '', $is_deleted = false)
    {
        $ses = $this->authorize_user();
        $req = new \Core\Request;
        $username = $ses->user('username');
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $data['is_deleted'] = false;

        if ($req->get('invent') != '') {
            $search = $req->get('invent');

            return $this->search_by_invent($search, false, $username);
        }
        if ($username == 'admin') {
            $claims = $data['claims']->get_my_claims(['is_deleted' => $is_deleted]);
        } else {
            $claims = $data['claims']->get_my_claims(['res' => $username, 'is_deleted' => $is_deleted]);
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
    //Edit claim
    public function edit()
    {
        $ses = $this->authorize_user();
        $data = $this->authorize_user_can_edit();
        $req = new \Core\Request;
        $claim_id = $req->get('id');

        $data['claim'] = new \Model\Claim;
        $claim_before_edited = $data['claim']->get_my_claims(['id' => $claim_id])[0];
        if ($req->posted()) {
            $new_claim = $req->post();
            // $new_claim += array('res' => $ses->user('username'));
            // $new_claim += array('user_id' => $ses->user('id'));
            $files = $req->files();
            $images_name = ['image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'claim_photo'];
            $image_AWS = [];
            $image_err = [];
            $check_before_image = $data['claim']->validate($new_claim);
            if ($check_before_image) {
                foreach ($images_name as $image_name) {
                    if (!empty($files[$image_name]['name'])) {
                        $image_AWS = $this->upload($files, $image_name);
                        // var_dump($image_AWS['status']);
                        if (isset($image_AWS['errors']) &&  count($image_AWS['errors']) > 0) {

                            foreach ($image_AWS['errors'] as $key => $value) {
                                $newArray[$key] = $value;
                                $image_err += array($key => $value);
                            }
                        } else {
                            if ($image_AWS['status'] == 'error') {
                                $image_err += array($image_name => $image_AWS['message']);
                            } else {

                                $new_claim += array($image_name => $image_AWS['link']);
                                if ($claim_before_edited->$image_name != '') {

                                    $this->deleteImage($claim_before_edited->$image_name);
                                }
                            }
                        }
                    }
                }
            }


            $data['claim']->update_claim($claim_id, $new_claim);

            $data['claim']->get_my_claims(['id' => $claim_id]);
            $data['claim']->errors += $image_err;
            // var_dump($data['claim']->errors);
            if (count($data['claim']->errors) == 0) {

                $this->get_my_claims('Заявка успешно отредактирована');
            } else {

                $this->view('edit', $data);
            }
        } else {
            $this->view('edit', $data);
        }
    }
    //Delete a cliam
    public function delete()
    {
        $data = $this->authorize_user_can_edit();
        $claim = new \Model\Claim;
        $claim->update($data['data']->id, ['is_deleted' => true, 'deleted_at' => date('Y-m-d H:i:s')]);
        $this->get_my_claims('Успешно удаленно!', true);
        // var_dump($data['data']);
    }
    //Seacrh by invent
    public function search_by_invent($search, $is_deleted = false, $res = '')
    {
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;
        $limit = 10;
        $data['pager'] = new Pager($limit);
        $offset = $data['pager']->offset;
        $data['claims']->limit = $limit;
        $data['claims']->offset = $offset;
        $data['is_deleted'] = $is_deleted;
        $claims = $data['claims']->search(['invent_num' => $search, 'is_deleted' => $is_deleted, 'res' => $res]);

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
