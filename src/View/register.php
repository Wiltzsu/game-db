<?php 
namespace App\Controller;

use App\Model\UserRegister;
use App\Database;

require_once 'header.php';
session_start();

$db = Database::connect();
$userRegController = new UserRegController($db);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];

    $result = $userRegController->createUser($username, $email, $password, $password2);

    if ($result['success']) {
        $_SESSION['userId'] = $result['userId'];
        header("Location: /game-db/login");
        exit;
    } else {
        $errors = $result['errors'];
    }
}

?>
<div class="row">
    <div class="col-sm-12 mb-5">
        <main class="form-signin w-50 m-auto">
            <form method="POST">
                <h1 class="h3 mt-5 fw-normal text-center">Register</h1>

                <div class="form-floating m-1">
                    <input type="text" class="form-control" id="username" name="username" placeholder="">
                    <label for="username">Username</label>
                    <?php if (!empty($errors['username'])): ?>
                        <div class="text-danger"><?= $errors['username'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating m-1">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="text-danger"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating m-1">
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    <label for="password1">Password</label>
                                        <?php if (!empty($errors['password'])): ?>
                        <div class="text-danger"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating m-1">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-enter Password">
                    <label for="password2">Re-enter password</label>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="text-danger"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>

                <button class="w-100 btn btn-lg btn-dark" type="submit" name="submit">Register</button>
            </form>
        </main>
    </div>
</div>