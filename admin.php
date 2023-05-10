<?php session_start();?>
<?php require "connect.php";?>
<?php
if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We are a community-driven website offering information about upcoming game releases on PC, Playstation 5, Playstation 4, Xbox Series X, Xbox One and Nintendo Switch.">
    <meta name="keywords" content="upcoming games, PC games, Playstation 5, Playstation 4, Xbox Series X, Xbox One, Nintendo Switch">
    <title>gamersOut - Game release dates</title>
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


<div class="container">

    <div class="row">
        <p><a href="index.php">FRONT PAGE</a> - <a href="logout.php">LOGOUT</a></p>
    </div>

    <div class="row text-center pb-3">
        <div class="col-sm-12">
        <!-- Alert if game edit is successful, gets the value from updategame.php -->
        <?php if(isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game edited!</strong> Nice admin work.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Alert if game delete is successful, gets the value from updategame.php -->
        <?php if(isset($_GET['delete'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game deleted!</strong> Good admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Alert for deleted user game -->
        <?php if(isset($_GET['usergamedeleted'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game deleted!</strong> Nice admin action!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Alert for user added game approval -->
        <?php if(isset($_GET['usergameadded'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game deleted!</strong> Nice admin work!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
            <h2>Welcome to the Admin panel!</h2>
        </div>

    </div>

    <div class="row text-center pb-3">
        <div class="col-sm-4">
            <p><a class="btn btn-danger btn-lg" href="addgame.php">Add game</a></p>
        </div>
        <div class="col-sm-4">
            <p><a class="btn btn-danger btn-lg" href="editgame.php">Edit game</a></p>
        </div>
        <div class="col-sm-4">
            <p><a class="btn btn-danger btn-lg" href="useraddedgames.php">User added games</a></p>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-sm-12">
        <img src="img/sieni-nobg.png" id="sieni" class="mx-auto">
        </div>
    </div>

</div>

</div>


<?php require "footer.php";?>
