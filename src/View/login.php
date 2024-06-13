<?php 
session_start();
require_once __DIR__ . '/../Config/connect.php';

require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection = $db->users;
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = $collection->findOne(['email' => $email]);
    
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = (string) $user['_id'];
        $_SESSION['name'] = $user['name'];
        
        echo "Login successful!";
        // Redirect to a logged-in page
        header("Location: /game-db/view/main_view.php");
    } else {
        // Invalid login attempt
        echo "Invalid email or password!";
    }
}
?>



<?php

?>
    <div class="row">
        <div class="col-sm-12 mb-5">
            <main class="form-signin w-50 m-auto">
            <form method="POST" action="login.php">
                    <h1 class="h3 mt-5 fw-normal text-center">Please login</h1>
                    <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email</label>
                    </div>
                    <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-dark" type="submit" name="submit">Login</button>
                </form>
            </main>
        </div>
    </div>
</div>
