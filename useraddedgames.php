<div class="row">
        <div class="col-sm-12">
            <h4>User added games waiting for approval</h4>
        </div>
    </div>

    <div class="row pb-5">
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