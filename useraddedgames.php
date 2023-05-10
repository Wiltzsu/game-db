<?php session_start(); ?>



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


<body>
    <div class="container tableborders">
        <div class="row">
            <div class="col-sm-12 purplecontainer pl-5 pr-5 pb-4"> 
            <img src="img/gamersout3.png" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <div class="row pl-3" style="background-color:black">
        <!-- Checks if session is active and shows the control panel if it is -->
        <?php if(isset($_SESSION['adminemail'])) { ?>
            <p><a href="admin.php">ADMIN PANEL</a> - <a href="logout.php">LOGOUT</a></p>
          <?php } ?>
        </div>
    </div>

    <div class="container">
        <div class="row p-3">
            <div class="col-sm-12">
                <h3>Edit game added by user</h3>
            <!-- Alert for edited user game -->
            <?php if(isset($_GET['usergameedited'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Game edited!</strong> Choo choo!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
                <table class="table table-striped">
                <tr>
                    <th class="col-4">Title</th>
                    <th class="col-2">Release date</th>
                    <th class="col-3">Developer</th>
                    <th class="col-3">Platform</th>
                    <th class="col-3"></th>
                    <th class="col-3"></th>
                    <th class="col-3"></th>
                </tr>
                <?php
                // Check if file exists and readable
                include('gamelisting2.php');
                if(file_exists("data2.json") && is_readable("data2.json")) {
                    $json_data2 = file_get_contents("data2.json");
                    $games = json_decode($json_data2, true);
                }

                // Check if data is an array
                if(is_array($games)) {
                        foreach ($games as $key) {
                            foreach ($key as $game) {
                            ?>
                            <tr>
                                <td class="col-3"> <?php echo $game['Title']; ?></td>
                                <td class="col-3"> <?php echo $game['Release']; ?></td>
                                <td class="col-3"> <?php echo $game['Developers']; ?></td>
                                <td class="col-3"> <?php echo $game['Platform']; ?></td>
                        
                            </tr>
                            <tr>
                                <!-- Browser sends a GET request to approve.php with jasenid of jasen as query parameter -->
                                <td class="col-"><?php echo '<a href=approve.php?usergameid='.$game['usergameid'].'" class="btn btn-success ">Approve</a'; ?></td>
                                <!-- Browser sends a GET request to paivitaJasen.php with jasenid of jasen as query parameter -->
                                <td class="col-">
                                <?php echo '<a href=editapproval.php?usergameid='.$game['usergameid'].'" class="btn btn-warning">Edit</a'; ?></td>                   
                                <!-- Browser sends a GET request to poistaJasen.php with email address of jasen as query parameter -->
                                <td class="col-"><?php echo '<a href="deletegame.php?usergameid='.$game['usergameid'].'" class="btn btn-danger">Delete</a>'; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!--FOOTER-->
    <div class="container tableborders">
        <div class="row">
            <div class="col-sm-12 purplecontainer text-center">
            <img src="img/gamersout3.png" class="img-fluid footerimg" alt="Responsive image">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 purplecontainer text-center" style="color: white">
            <p>contact@gamersout.com</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 purplecontainer text-center" style="color: white">
            <p>Copyright 2022 © gamersout.com</p>
            </div>
        </div>
    </div>