
<?php
require "connect.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

try {
    // Uses superglobal $_GET to retrieve the value of "usergameid" parameter passed in the URL
    $usergameid = $_GET['usergameid'];
 
    // Print to screen, debugging statement
    echo "<br>usergameid: $usergameid<br>";

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
            header('Location: admin.php');
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

<div class="container mt-5 p-3">
    <div class="row">
        <div class="col">
            <h2>Päivitä tietoja</h2>
            <a href="admin.php">Takaisin listaan</a>
            <form method="POST" action="editapproval.php?usergameid=<?php echo $usergameid; ?>" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Uusi etunimi</label>
                    <input name="new_title" type="text" class="form-control" id="inputPassword2" placeholder="Title" value="<?php echo $usergame_title ; ?>">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Uusi sukunimi</label>
                    <input name="new_releasedate" type="text" class="form-control" id="inputPassword2" placeholder="Release date" value="<?php echo $usergame_release ; ?>">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Uusi sähköposti</label>
                    <input name="new_developer" type="text" class="form-control" id="inputPassword2" placeholder="Developer" value="<?php echo $usergame_developer ; ?>">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Uusi puhelin</label>
                    <input name="new_platform" type="text" class="form-control" id="inputPassword2" placeholder="Platform" value="<?php echo $usergame_platform ; ?>">
                </div>
                <button name="laheta" type="submit" class="btn btn-primary mb-2">Update</button>
            </form>
        </div>
    </div>
</div>
