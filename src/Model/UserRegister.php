<?php
/**
 * File for user registration.
 * 
 * @package GameDb
 * @author  William
 * @license MIT License
 */
namespace App\Model;

use MongoDB\Client;

class UserRegister
{
    private $_db;
    private $_username;
    private $_email;
    private $_password;
    private $_hashedPassword;

    public function __construct($db)
    {
        $this->_db = $db;
    }
}