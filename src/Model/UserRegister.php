<?php
/**
 * File for user registration.
 * 
 * @package GameDb
 * @license MIT License
 */

namespace App\Model;

/**
 * User registration class containing methods.
 * 
 * @var $_db            Database connection variable.
 * @var $_collection    Database collection variable.
 */
class UserRegister
{
    private $_db;
    private $_collection;

    /**
     * Initialize the class with a database connection.
     * 
     * @param $db MongoDB database connection.
     */
    public function __construct(\MongoDB\Database $db)
    {
        $this->_db = $db;
        $this->_collection = $this->_db->users;
    }

    /**
     * Validates user input.
     * Checks for input lengths, existing values and input type.
     * 
     * @param $username  Username.
     * @param $email     Email.
     * @param $password  Password.
     * @param $password2 Re-enter password.
     * 
     * @return Array Returns array of errors.
     */
    public function validateInput($username, $email, $password, $password2)
    {
        $errors = [];
        if (empty($username)) {
            $errors['username'] = 'Please enter a valid username.';
        }
        if (strlen($username) < 4 || strlen($username) > 32) {
            $errors['username'] = 'Username must be between 4 and 32 characters.';
        } elseif ($this->_collection->findOne(['username' => $username])) {
            $errors['username'] = 'Username already in use.';
        }
        if (strlen($password) < 4 || strlen($password) > 72) {
            $errors['password'] = 'Password must be between 4 and 72 characters.';
        }
        if ($password !== $password2) {
            $errors['password'] = 'Passwords do not match.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        } elseif ($this->_collection->findOne(['email' => $email])) {
            $errors['email'] = 'Email is already in use.';
        }
        return $errors;
    }

    /**
     * Validates input and inserts the user to the database.
     * Converts 'userID' to a string to get standardized output.
     * 
     * @param $username  Username of the user.
     * @param $email     Email of the user.
     * @param $password  User password.
     * @param $password2 Password re-enter.
     * 
     * @return Array Returns array with a 'success' key.
     */
    public function registerUser($username, $email, $password, $password2)
    {
        $errors = $this->validateInput($username, $email, $password, $password2);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password];
        $result = $this->_collection->insertOne($user);
        return ['success' => true, 'userId' => (string)$result->getInsertedId()];
    }
}