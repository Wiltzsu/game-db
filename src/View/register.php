<?php 
require_once 'header.php';
require_once __DIR__ . '/../config/connect.php';
?>

<div class="row">
    <div class="col-sm-12 mb-5">
        <main class="form-signin w-50 m-auto">

        
        <form method="POST" action="register.php">
                <h1 class="h3 mt-5 fw-normal text-center">Register</h1>

                    <div class="form-floating m-1">
                        <input type="username" class="form-control" id="username" name="username" placeholder="">
                        <label for="username">Username</label>
                    </div>

                    <div class="form-floating m-1">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating m-1">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <div class="form-floating m-1">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                        <label for="password">Re-enter password</label>
                    </div>

                <button class="w-100 btn btn-lg btn-dark" type="submit" name="submit">Login</button>
            </form>
        </main>
    </div>
</div>
