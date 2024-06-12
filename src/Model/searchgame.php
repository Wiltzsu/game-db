<?php

include("connect.php");

$error_message = '';

if (isset($_GET['title']) && !empty($_GET['title'])) {
    try {
        // Get title
        $title = $_GET['title'];

        // SQL query
        $query = "SELECT * FROM games WHERE title LIKE '%$title%'";
        $data = $yhteys->query($query);

        // Check if any rows were returned
        if ($data->rowCount() > 0) {
            // Save to JSON file
            $JSON = '{"games":[';
            $count = 0;
            $rows = $data->rowCount();

            // Iterate rows and append to JSON 
            while($row = $data->fetch(PDO::FETCH_ASSOC)) {
                $count++;
                // Date to dd/mm/yyyy
                $releasedate = new DateTime($row['releasedate']);
                $releasedate_formatted = $releasedate->format('d/m/Y');

                $JSON.='{"gameid":"'.$row['gameid'].'","Release":"'.$releasedate_formatted.'","Title":"'.$row['title'].'","Developers":"'.$row['developer'].'","Platform":"'.$row['platform'].'"}';
                if($count<$rows) $JSON.=",";
            }

            // Close JSON file
            $JSON .= ']}';

            // Write to JSON
            $handler = fopen("data.json", "w");
            fwrite($handler, $JSON);
            fclose($handler);
        } else {
            $error_message = "<p style='color:red'>Title not found</p>";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $error_message = "<p style='color:red'>Title not found</p>";
}
?>
    <!--Search-->
    <div class="row search-results">
      <table class="table table-striped" >
        <?php
        if(isset($_GET['title'])) {

          // Check if file exists and readable
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
                    <th class="col-4">Title</th>
                    <th class="col-2">Release date</th>
                    <th class="col-3">Developer</th>
                    <th class="col-3">Platform</th>
                  </tr>
                <tr>
                  <td class="col-4"> <?php echo $game['Title']; ?></td>
                  <td class="col-2"> <?php echo $game['Release']; ?></td>
                  <td class="col-3"> <?php echo $game['Developers']; ?></td>
                  <td class="col-3"> <?php echo $game['Platform']; ?></td>
                </tr>

                <?php
              }
            }
            ?>
                <div class="mx-auto"> <!-- Redirect indexiin vois tehä -->
                <?php echo $error_message;?>
                  <button class="btn btn-secondary hide-results mb-2" onclick=hideResults()>Hide results</button>
                </div>
                <?php
          }
        }
        ?>
      </table>
    </div>