<?php 
session_start();
ob_start();
require "connect.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We provide gamers information on upcoming game release dates for PC, PlayStation (5 & 4), Xbox (Series X & One), and Nintendo Switch">
    <meta name="keywords" content="upcoming games, PC games, Playstation 5, Playstation 4, Xbox Series X, Xbox One, Nintendo Switch">
    <title>gamersOut - Your comprehensive source for game release dates</title>
    <link rel="icon" type="image/x-icon" href="img/gamersout2.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    <link rel="stylesheet" href="./css/style.css">
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LczX54lAAAAAFbt65LDoTrH7ZBHqmJS60Z1mn9W"></script>
    <script src="./javascript/javascript.js"></script>
    <script src="./javascript/bootstrap.bundle.js"></script>
    <script src="./javascript/bootstrap.min.js"></script>
  </head>

<body>
<div class="container tableborders">
    <div class="row">
        <div class="col-sm-12 purplecontainer pl-5 pr-5 pb-4">
          <img src="img/gamersout3.png" class="img-fluid" alt="Responsive image">
        </div>
    </div>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>