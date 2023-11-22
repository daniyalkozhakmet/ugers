<?php

namespace Thunder;

use Model\Database;
use Model\User;

defined('CPATH') or exit('Access Denied!');

class Thunder
{
    use Database;
    public function create()
    {
        try {
            //code...
            $this->createTables();
            echo "Tables created";
        } catch (\Throwable $th) {
            //throw $th;
            echo "Failed";
        }
        $this->createTables();
    }
    public function seed()
    {
        try {
            //code...
            $user = new User();
            $user->seedUsers();
            echo "Data seed";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
}
