<?php
require "connect.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
    if (isset($_GET['title'])) {
    try {
        $title = $_GET['title'];
        $query = "SELECT * FROM games WHERE title LIKE '%$title%'";
        $data = $yhteys->query($query);
        $rows = $data->fetch(PDO::FETCH_OBJ);
        if ($rows) {
            $current_title = $rows->title;
            $current_releasedate = $rows->releasedate;
            $current_developer = $rows->developer;
            $current_platform = $rows->platform;
        } else {
            $error_message = "<p style='color:red'>Title not found</p>";
        }
    } catch (PDOException $e) {
        $error_message = "<p style='color:red'>Error:</p> " . $e->getMessage();
    } catch (Exception $e) {
        $error_message = "<p style='color:red'>Error:</p> " . $e->getMessage();
    }
}

if (isset($_POST['laheta'])) {
    $new_reknro = $_POST['title'];
    $new_valmistaja = $_POST['releasedate'];
    $new_malli = $_POST['developer'];
    $new_hinta = $_POST['platform'];

    $query = "UPDATE games SET title = '$new_reknro', releasedate = '$new_valmistaja', developer = '$new_malli', platform = '$new_hinta' WHERE title = '$title'";
    $yhteys->exec($query);

    header('Location: admin.php');
    exit();
} else if (isset($_POST['poista'])) {
    $title = $_GET['title'];
    $query = "DELETE FROM games WHERE title = :title";
    $poista = $yhteys->prepare($query);
    $poista->bindValue(':title', $title, PDO::PARAM_STR);
    $poista->execute();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>gamersOut</title>
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
            <div class="col-sm-12 purplecontainer pl-5 pr-5 pb-4"> 
            <img src="img/gamersout3.png" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <div class="row pl-3" style="background-color:black">
        <!-- Checks if session is active and shows the control panel if it is -->
        <?php if(isset($_SESSION['adminemail'])) { ?>
                <p><a href="admin.php">Back to admin panel</a> <a href="logout.php">Logout</a></p>
            <?php } ?>
        </div>
    </div>

<div class="container p-5">
    <div class="row mx-auto pb-3">
        <div class="col-sm-12">

        <h3>Edit game</h3>
            <!-- Display error message -->
            <form action="updategame.php" method="GET">
                <label>Game title:</label>
                <input type="text" name="title" style="display: inline-block;" class="form-control col-6">
                <button type="submit" class="btn btn-warning">Search game</button><br><br>
            </form>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-1GhqOgQlVoZvH8wGpFYiKlLVzL81sUSsDdW1lG2aiTUvx3cXvC9yhE8nsRnlCpwR" crossorigin="anonymous"></script>
  </body>
</html>
