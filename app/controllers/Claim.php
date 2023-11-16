<?php


namespace Controller;

require(__DIR__ . '/../../vendor/autoload.php');

use Aws\Exception\CredentialsException;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Model\Image;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * login class
 */
class Claim
{
    use MainController;
    public function authorize_user()
    {
        $ses = new \Core\Session;
        if (!$ses->is_user()) {
            redirect('login');
            return false;
        }
        return $ses;
    }

    public function authorize_user_can_edit()
    {
        $ses = $this->authorize_user();
        $req = new \Core\Request;
        $data['claim'] = new \Model\Claim;
        $data['error'] = '';
        $username = $ses->user('username');
        $claim_id = $req->get('id');
        if ($claim_id == '')
            return redirect('claim/get_my_claims');

        $claim = $data['claim']->get_single_claim(['id' => $claim_id]);
        if (is_string($claim)) {
            $data['error'] = $claim;
        } else {
            var_dump($claim->res == $username);
            if ($claim->res == $username) {
                $data['claim'] = $claim;
                return $data;
            }
        }
        $data['error'] = "Access denied";
        $data['claim'] = null;
        return $data;
    }
    public function index()
    {
        $ses = $this->authorize_user();
        $this->view('claims');
    }
    public function single()
    {
        $data = $this->authorize_user_can_edit();
        var_dump($data);
        $this->view('claims');
    }
    public function create()
    {
        $ses = $this->authorize_user();
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
                        // var_dump($image_AWS);
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
                                // $data['claim']->errors += $image_AWS['message'];
                            }
                        }
                    }
                }
            }



            $data['claim']->create($new_claim);
            $data['claim']->errors += $image_err;
        }
        $this->view('create', $data);
    }
    public function upload($files, $image_name)
    {

        $folder = 'uploads/';
        $s3 = new AWS();
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
            file_put_contents($folder, 'index.php', "");
        }
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (in_array($files[$image_name]['type'], $allowed)) {

            $new_claim[$image_name] = $folder . time() . rand(0, 1000) . $files[$image_name]['name'];
            var_dump($files[$image_name]['type']);
            $response = $s3->putObject($files[$image_name]['tmp_name'], $new_claim[$image_name],$files[$image_name]['type']);
            var_dump($new_claim[$image_name]);
            move_uploaded_file($files[$image_name]['tmp_name'], $new_claim[$image_name]);
            $image = new Image;
            $image->resize($new_claim[$image_name], 1000);
            return $response;
        } else {
            $response['errors'] = [];
            $response['errors'] += array($image_name => 'File type not supported');
            return $response;
        }
    }
    public function into_bucket($file_src, $file_name)
    {

        $s3 = new S3Client([
            'version' => VERSION,
            'region' => REGION,
            'credentials' => [
                'key' => ACCESSKEYID,
                'secret' => SECRETACCESSKEY,
            ]
        ]);
        $response = [];
        try {
            $result = $s3->putObject([
                'Bucket' => BUCKET,
                'Key' => $file_name,
                'ACL' => 'public-read',
                'SourceFile' => $file_src,
            ]);
            $result_arr = $result->toArray();
            if (!empty($result_arr['ObjectURL'])) {
                $s3_file_link = $result_arr['ObjectURL'];
                $response += array('link' => $s3_file_link);
            } else {
                $api_err = 'FAIL';
            }
        } catch (S3Exception $e) {
            $api_err = $e->getMessage();
            //throw $th;
        }
        if (empty($api_err)) {
            $status = 'success';
            $statusMsg = 'Uploaded';
        } else {
            $statusMsg = $api_err;
            $status = [$file_name => 'Errorrr'];
        }
        $response += array('status' => $status);
        $response += array('message' => $statusMsg);
        return $response;
    }
    public function get_my_claims()
    {
        $ses = $this->authorize_user();
        $req = new \Core\Request;
        $username = $ses->user('username');
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;

        if ($req->get('invent') != '') {
            $search = $req->get('invent');
            return $this->search_by_invent($search);
        }
        $claims = $data['claims']->get_my_claims(['res' => $username]);
        if (is_string($claims)) {
            $data['error'] = $claims;
            $this->view('myclaims', $data);
            return;
        }

        $data['claims'] = $claims;
        $this->view('myclaims', $data);
    }

    public function edit()
    {
        $data = $this->authorize_user_can_edit();
        var_dump($data);
    }
    public function search_by_invent($search)
    {
        $data['claims'] = new \Model\Claim;
        $data['error'] = null;

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
