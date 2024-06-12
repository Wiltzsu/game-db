<?php 
require_once 'header.php';
?>



<?php
           if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $passwd = $_POST['password'];

            if (empty($email) || empty($passwd)) {
                echo '<div class="alert alert-danger">Väärä sähköposti tai salasana</div>';
            } else {
                $kirjaudu = $yhteys->prepare("SELECT * FROM users WHERE email = ?");
                $kirjaudu->execute([$email]);
                $user = $kirjaudu->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if (password_verify($passwd, $user['passwd'])) {
                        $_SESSION['adminemail'] = $user['email'];
                        header("Location: admin.php");
                        exit;
                    } else {
                        echo '<div class="alert alert-danger">Väärä sähköposti tai salasana</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Väärä sähköposti tai salasana</div>';
                }
            }
        }
        ob_end_flush();
?>
    <div class="row">
        <div class="col-sm-12 mb-5">
            <main class="form-signin w-50 m-auto">
                <form method="post">
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
