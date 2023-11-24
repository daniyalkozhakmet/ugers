<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Core\Session;
use \Model\User;
use \Model\Feedback;
use \Core\Request;
use \Model\Image;

/**
 * ajax class
 */
class Ajax
{
    use MainController;

    public function check_if_logged_in()
    {
        if (!empty($_SESSION['USER'])) {
            // User is logged in
            echo json_encode(true);
        } else {
            // User is not logged in
            echo json_encode(false);
        }
    }
}
