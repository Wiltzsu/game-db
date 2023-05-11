<?php 
session_start();

if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }

require "header.php";
?>

<div class="container">

    <div class="row">
        <p><a href="index.php">FRONT PAGE</a> - <a href="logout.php">LOGOUT</a></p>
    </div>

    <div class="row text-center pb-3">
        <div class="col-sm-12">
        <!-- Alert if game is added, gets the value from addgame.php -->
        <?php if(isset($_GET['gameadd'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game added!</strong> Nice work.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Alert if game edit is successful, gets the value from updategame.php -->
        <?php if(isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game edited!</strong> Top tier admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Alert if game delete is successful, gets the value from updategame.php -->
        <?php if(isset($_GET['delete'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Game deleted!</strong> Good.
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
            <h2><strong>ADMIN PANEL</strong></h2>
        </div>

    </div>

    <div class="row text-center pb-3 pt-3">
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
