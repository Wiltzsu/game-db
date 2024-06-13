<?php
namespace App\Controller;

use App\Model\UserRegister;
use App\Database;

class UserRegController
{
    private $_userRegisterModel;

    public function __construct($db)
    {
        $this->_userRegisterModel = new UserRegister($db);
    }

    public function createUser($username, $email, $password, $password2)
    {
        return $this->_userRegisterModel->registerUser($username, $email, $password, $password2);
    }
}
