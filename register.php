<?php require "connect.php";?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <!-- Javascript -->
    <script src="./javascript/javascript.js"></script>
    <script src="javascript/bootstrap.bundle.js"></script>

    <title>Gamersout</title>

  </head>

<body>
    

<div class="container tableborders">
    <div class="row">
        <div class="col-sm-12 purplecontainer pl-5 pr-5 pb-4">
          <img src="img/gamersout3.png" class="img-fluid" alt="Responsive image">
        </div>
    </div>

<?php
if(isset($_POST['submit'])) {
    if($_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '') {
        echo "Something is missing";
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $passwd = $_POST['password'];

        $add = $yhteys->prepare("INSERT INTO users (email, username, passwd) VALUES (:email, :username, :passwd)");
        $add->execute([
            ':email' => $email,
            ':username' => $username,
            ':passwd' => password_hash($passwd, PASSWORD_DEFAULT),
        ]);
    }
}
?>

        <div class="row">
            <div class="col-sm-12">
            <main class="form-signin w-50 m-auto">
                <form method="POST" action="register.php">
                
                    <h1 class="h3 mt-5 fw-normal text-center">Please register</h1>

                    <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    </div>

                    <div class="form-floating">
                    <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
                    <label for="floatingInput">Username</label>
                    </div>

                    <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>

                    <button name="submit" class="w-100 btn btn-lg btn-dark" type="submit">Register</button>
                    <h6 class="mt-3">Have a username? <a href="login.php">Login</a></h6>

                </form>
                </main>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
