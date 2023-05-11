
<?php
require "connect.php";
require "header.php";
?>


<?php
if(isset($_POST['save'])) {
    $title=$_POST['title'];
    $releasedate=$_POST['releasedate'];
    $developer=$_POST['developer'];
    $platform=$_POST['platform'];

    $query="INSERT INTO games(title, releasedate, developer, platform)
            VALUES(:title, :releasedate, :developer, :platform)";

        $add = $yhteys->prepare($query);
        $add->bindValue(':title', $title, PDO::PARAM_STR);
        $add->bindValue(':releasedate', $releasedate, PDO::PARAM_STR);
        $add->bindValue(':developer', $developer, PDO::PARAM_STR);
        $add->bindValue(':platform', $platform, PDO::PARAM_STR);
        $add->execute();
        header('Location: admin.php?gameadd=true');
}

?>

<?php 
if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }
?>

    <div class="container ">
        <div class="row" style="background-color:black">
            <!-- Checks if session is active and shows the control panel if it is -->
            <?php if(isset($_SESSION['adminemail'])) { ?>
                    <p><a href="admin.php">ADMIN PANEL</a> - <a href="logout.php">LOGOUT</a></p>
            <?php } ?>
        </div>
        <div class="row p-3">
            <div class="col-sm-12">
                <h3 class="">Add game</h3>
                <table class="table mx-auto">
                    <form action="addgame.php" method="POST">
                        <tr>
                            <td>Title</td>
                            <td><input type="text" name="title" class="form-control col-sm-12" required></td>
                        </tr>
                        <tr>
                            <td>Release date</td>
                            <td><input type="date" name="releasedate" class="form-control col-sm-12"></td>
                        </tr>
                        <tr>
                            <td>Developer</td>
                            <td><input type="text" name="developer" class="form-control col-sm-12"></td>
                        </tr>
                        <tr>
                            <td>Platform</td>
                            <td><input type="text" name="platform" class="form-control col-sm-12"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button name="save" type="submit" class="btn btn-primary">Add</button></td>
                        </tr>
                    </form>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-1GhqOgQlVoZvH8wGpFYiKlLVzL81sUSsDdW1lG2aiTUvx3cXvC9yhE8nsRnlCpwR" crossorigin="anonymous"></script>
  </body>
</html>