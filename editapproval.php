<?php 
session_start();

if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }

require "header.php";
?>

<?php
try {
    // Uses superglobal $_GET to retrieve the value of "usergameid" parameter passed in the URL
    $usergameid = $_GET['usergameid'];

    // Search database for usergameid in usergames table
    $kysely = "SELECT * FROM usergames WHERE usergameid = '$usergameid'";
    $data = $yhteys->query($kysely);
    // If the record is found, it's fetched and stored in rivit variable
    $rivit = $data->fetch(PDO::FETCH_OBJ);

    // If a record was found, 
    if ($rivit) {
        // retrieve the title column value and store it in usergame_title variable
        $usergame_title = $rivit->title;
        // retrieve the releasedate column value and store it in usergame_release variable
        $usergame_release = $rivit->releasedate;
        // retrieve the releasedate column value and store it in usergame_developer variable
        $usergame_developer = $rivit->developer;
        // retrieve the platform column value and store it in usergame_platform variable
        $usergame_platform = $rivit->platform;

        // Form submission
        if (isset($_POST['laheta'])) {
            // New title from the form input
            $new_title = $_POST['new_title'];
            // New releasedate from the form input
            $new_release = $_POST['new_releasedate'];
            // New developer from the form input
            $new_developer = $_POST['new_developer'];
            // New platform from the form input
            $new_platform = $_POST['new_platform'];

            // Update etunimi in database
            $kysely = "UPDATE usergames SET title = '$new_title' WHERE usergameid = '$usergameid'";
            $yhteys->exec($kysely);
            // Update sukunimi in database
            $kysely = "UPDATE usergames SET releasedate = '$new_release' WHERE usergameid = '$usergameid'";
            $yhteys->exec($kysely);
            // Update developer in database
            $kysely = "UPDATE usergames SET developer = '$new_developer' WHERE usergameid = '$usergameid'";
            $yhteys->exec($kysely);
            // Update platform in database
            $kysely = "UPDATE usergames SET platform = '$new_platform' WHERE usergameid = '$usergameid'";
            $yhteys->exec($kysely);

            // Redirect to index.php
            header('Location: useraddedgames.php?usergameedited=true');
            exit();
        }
    } else {
        throw new Exception("Jasen not found");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

    <div class="container p-3">
            <div class="row">
            <!-- Checks if session is active and shows the control panel if it is -->
            <?php if(isset($_SESSION['adminemail'])) { ?>
                <p><a href="useraddedgames.php">USER GAMES</a> - <a href="logout.php">LOGOUT</a></p>
            <?php } ?>
                <div class="col-sm-12">
                    <h2>Edit game specx</h2>
                    <form method="POST" action="editapproval.php?usergameid=<?php echo $usergameid; ?>" class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Give me a new title</label>
                            <input name="new_title" type="text" class="form-control" id="inputPassword2" placeholder="Title" value="<?php echo $usergame_title ; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">And a new release date</label>
                            <input name="new_releasedate" type="date" class="form-control" id="inputPassword2" placeholder="Release date" value="<?php echo $usergame_release ; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">How about the developer?</label>
                            <input name="new_developer" type="text" class="form-control" id="inputPassword2" placeholder="Developer" value="<?php echo $usergame_developer ; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">And the platforms</label>
                            <input name="new_platform" type="text" class="form-control" id="inputPassword2" placeholder="Platform" value="<?php echo $usergame_platform ; ?>">
                            <button name="laheta" type="submit" class="btn btn-primary mb-2 mt-2">Go!</button>
                        </div>

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