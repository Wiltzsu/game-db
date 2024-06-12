<?php 
session_start();

if(!isset($_SESSION['adminemail'])){
    header("Location: login.php");
    exit;
  }

require "header.php";
?>

    <div class="container-fluid content-container">
        <div class="row pl-3" style="background-color:black">
            <!-- Checks if session is active and shows the control panel if it is -->
            <?php if(isset($_SESSION['adminemail'])) { ?>
                <p><a href="admin.php">ADMIN PANEL</a> - <a href="logout.php">LOGOUT</a></p>
            <?php } ?>
        </div>
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
            <div class="table-responsive">
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
                                <td><?php echo '<a href="approve.php?usergameid='.$game['usergameid'].'" class="btn btn-success">Approve</a>'; ?></td>
                                <td><?php echo '<a href="editapproval.php?usergameid='.$game['usergameid'].'" class="btn btn-warning">Edit</a>'; ?></td>
                                <td><?php echo '<a href="deletegame.php?usergameid='.$game['usergameid'].'" class="btn btn-danger">Delete</a>'; ?></td>
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
    </div>

    <!--FOOTER-->
<?php require "footer.php"?>