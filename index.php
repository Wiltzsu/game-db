<?php 
require "connect.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

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

    <script>
      function onSubmit(token) {
        // Do something with the token, such as submitting the form data to your server
        document.getElementById("myForm").submit();
      }
      grecaptcha.ready(function() {
        grecaptcha.execute('6LczX54lAAAAAFbt65LDoTrH7ZBHqmJS60Z1mn9W', {action: 'submit'}).then(function(token) {
          // Add the token to your form data and submit the form
          document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("token").value = token;
            this.submit();
          });
        });
      });
    </script>

  </head>

<body>
  <div class="container tableborders">
      <div class="row">
          <div class="col-sm-12 purplecontainer ">
          <img src="img/gamersout3 (1).png" class="img-fluid" alt="Responsive image">
          </div>
      </div>
  </div>


  <div class="container transpcontainer">
    <div class="row pl-3" style="background-color:black">
      <!-- Checks if session is active and shows the control panel if it is -->
      <?php if(isset($_SESSION['adminemail'])) { ?>
            <p><a href="admin.php">ADMIN PANEL</a> - <a href="logout.php">LOGOUT</a></p>
          <?php } ?>
    </div>
      <?php if(isset($_GET['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          Your new game has been submitted succesfully and sent to be reviewed, thank you for contributing!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>  
    <div class="row d-flex justify-content-between">
        <div class="col-md-4 mb-3 d-flex align-items-stretch">
          <div class="orangecontainer1 p-4">
          <h5 class="card-title">Welcome to gamersOut!</h5>
          <p class="card-text">We are a community-driven website offering information about upcoming game releases on PC, Playstation 5, Playstation 4, Xbox Series X, Xbox One and Nintendo Switch.</p>
          </div>
        </div>

        <div class="col-md-4 mb-3 d-flex align-items-stretch">
          <div class="orangecontainer2 p-4">
          <h5 class="card-title">Add a game</h5>
          <p class="card-text">If you know about an upcoming game release that we haven't covered yet, you can suggest it to us!</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newgame">
              Add game
            </button>

            <!-- Modal -->
            <div class="modal fade" id="newgame" tabindex="-1" aria-labelledby="newgameLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-ll">
                <div class="modal-content border-dark">
                  <div class="modal-header bg-dark ">
                    <h1 class="modal-title fs-5 text-light" id="newgameLabelLabel">Add a new game</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php include "newgame.php" ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 d-flex align-items-stretch">
          <div class="orangecontainer3 p-4">
          <h5 class="card-title">Discover your next game</h5>
          <p class="card-text">Don't know what to play next? Let destiny guide you! Click the button and try your luck.</p>
          </p>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#randomgame" onclick="getRandomGame()">Let's go</button>

            <!-- Modal -->
            <div class="modal fade" id="randomgame" tabindex="-1" aria-labelledby="randomgameLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-l">
                <div class="modal-content border border-dark">
                  <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="randomgameLabel">Random game for you</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <table class="text-dark text-center" id="random-game-table">

                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateGameTable()">Nah... another one</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="container mb-2">
    <!-- Search results -->
    <div class="row ">
      <div id="search-results"></div>
    </div>
  </div>

<div class="container">
  <div class="row p-3">
    <div class="col-sm-8" style="display: flex; justify-content: left; align-items: center;">
      <h4>Upcoming releases</h4>
    </div>
    <div class="col-sm-4">
      <form id="search-form">
        <div class="input-group">
          <input type="text" name="title" class="form-control" placeholder="Search by title">
          <span class="input-group-addon">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>


  <div class="row">
    <div class="table-responsive">
      <table class="table table-striped ">
        <tr>
          <th class="col-4 tableheader1">Title</th>
          <th class="col-2 tableheader2">Release date</th>
          <th class="col-3 tableheader2">Developer</th>
          <th class="col-3 tableheader3">Platform</th>
        </tr>
        <?php
        // Check if file exists and readable
        include('gamelisting.php');
        if(file_exists("data.json") && is_readable("data.json")) {
          $json_data = file_get_contents("data.json");
          $games = json_decode($json_data, true);
        }

        // Check if data is an array
        if(is_array($games)) {
          foreach ($games as $key) {
            foreach ($key as $game) {
              ?>
              <tr>
                <td class=""> <?php echo $game['Title']; ?></td>
                <td class=""> <?php echo $game['Release']; ?></td>
                <td class=""> <?php echo $game['Developers']; ?></td>
                <td class=""> <?php echo $game['Platform']; ?></td>
              </tr>
              <?php
            }
          }
        }
        ?>
      </table>
      </div>
  </div>

  <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <?php // counts the amount of pages needed by dividing total items in the database with set limit per page
    $total_items = $yhteys->query("SELECT COUNT(*) FROM games WHERE releasedate >= CURDATE()")->fetchColumn();
    $total_pages = ceil($total_items / $limit); // ceil = rounds up a given floating-point number to the nearest integer
        // checks if current page is bigger than 1 (ie not the first page)
    if ($page > 1) { //If page is not 1, creates a 'previous' link with pagenumber page - 1
      ?>
      <li class="page-item"> 
        <a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a>
      </li>
      <?php
    } else { // if page number is 1, creates a disabled previous button
      ?>
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <?php
    }

    for ($i=1; $i<=$total_pages; $i++) { // iterates from 1 to the amount of total pages
      ?> <!-- for each page number, it checks if it is equal to the current page number $page.
      If it is, "active" class will be added to the list item and highlights it -->
      <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
      <!--The page number is displayed inside the a anchor tag, which is linked to the page 
      url with the href attribute. href includes the page number as a query parameter
      ?page= -->
        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li>
      <?php
    }

    if ($page < $total_pages) { // checks if current page is less that total pages
      ?>
      <li class="page-item"><!--If it is less, it creates a link to next page with the url
      parameter $page+1 -->
        <a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a>
      </li>
      <?php
    } else { // If the current page is not less than total pages, it disabled the link item
      ?>
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Next</a>
      </li>
      <?php
    }
    ?>
  </ul>
  <br>
</nav>

</div>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>    
  </body>
</html>