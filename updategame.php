<?php 
if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }
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
    <div class="container">
        <div class="row" style="background-color:black">
            <!-- Checks if session is active and shows the control panel if it is -->
            <?php if(isset($_SESSION['adminemail'])) { ?>
                    <p><a href="editgame.php">Back to edit game</a> <a href="logout.php">Logout</a></p>
            <?php } ?>
        </div>
        <div class="row mx-auto p-3">
            <div class="col-sm-12">
                <?php
                $error_message = '';

                if (isset($_GET['title']) && empty($_GET['title'])) {
                    $error_message = "<h4 style='color:red'>Input is empty</h4>";
                    echo $error_message;
                } else {
                    try {
                        $title = $_GET['title'];
                    
                        $query = "SELECT * FROM games WHERE title = '$title'";
                        $data = $yhteys->query($query);
                        $rows = $data->fetch(PDO::FETCH_OBJ);
                    
                        if ($rows) {
                            $current_title = $rows->title;
                            $current_releasedate = $rows->releasedate;
                            $current_developer = $rows->developer;
                            $current_platform = $rows->platform;
                    
                            if (isset($_POST['laheta'])) {
                                $new_title = $_POST['title'];
                                $new_releasedate = $_POST['releasedate'];
                                $new_developer = $_POST['developer'];
                                $new_platform = $_POST['platform'];
                    
                                // Update values in database
                                $update = "UPDATE games
                                SET title = '$new_title', releasedate = '$new_releasedate', developer = '$new_developer', platform = '$new_platform'
                                WHERE title = '$title'";
                    
                                $yhteys->exec($update);
                                header('Location: admin.php?success=true');
                                exit();
                            } else if (isset($_POST['poista'])) {
                                $new_title = $_POST['title'];
                                $new_releasedate = $_POST['releasedate'];
                                $new_developer = $_POST['developer'];
                                $new_platform = $_POST['platform'];
                    
                                // Delete from database
                                $delete = "DELETE FROM games WHERE title = '$title'";
                    
                                $yhteys->exec($delete);
                                header('Location: admin.php?delete=true');
                                exit();
                            }
                        } else {
                            throw new Exception("<h4 style='color:red'>Could not find game</h4>");
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
                ?>
                <!-- Edit game info -->
                <h4>Edit result:</h4>    
                <form method="POST" action="updategame.php?title=<?php echo $title; ?>" >
                    <div class="mb-2">
                        <label for="inputPassword2" class="sr-only">New title</label>
                        <input name="title" type="text" class="form-control" id="inputPassword2" placeholder="Title"
                        <?php
                        if (!empty($current_title)) {
                            echo 'value="' . $current_title . '"';
                        }
                        ?>>
                    </div>
                    <div class="mb-2">
                        <label for="inputPassword2" class="sr-only">New release date</label>
                        <input name="releasedate" type="date" class="form-control" id="inputPassword2" placeholder="Release date"
                        <?php
                        if (!empty($current_releasedate)) {
                            echo 'value="' . $current_releasedate . '"';
                        }
                        ?>>
                    </div>
                    <div class=" mb-2">
                        <label for="inputPassword2" class="sr-only">New developer</label>
                        <input name="developer" type="text" class="form-control" id="inputPassword2" placeholder="Developer"
                        <?php
                        if (!empty($current_developer)) {
                            echo 'value="' . $current_developer . '"';
                        }
                        ?>>
                    </div>
                    <div class=" mb-2">
                        <label for="inputPassword2" class="sr-only">New platform</label>
                        <input name="platform" type="text" class="form-control" id="inputPassword2" placeholder="Platform"
                        <?php
                        if (!empty($current_platform)) {
                            echo 'value="' . $current_platform . '"';
                        }
                        ?>>
                    </div>
                    <button name="laheta" type="submit" class="btn btn-warning mb2">Update</button>
                    <button name="poista" type="submit" class="btn btn-danger mb2">Delete</button>
                </form>
            </div>
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