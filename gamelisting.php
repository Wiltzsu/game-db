<?php

include("connect.php");

$limit = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

# SQL query

$query = "SELECT gameid, releasedate, title, developer, platform FROM games WHERE releasedate >= CURDATE() ORDER BY releasedate LIMIT $start, $limit";
$data = $yhteys->query($query);

# Save to JSON file
$JSON='{"games":[';
$count = 0;
$rows = $data->rowCount();

# Iterate rows and append to JSON 
while($row = $data->fetch(PDO::FETCH_ASSOC)) {
    $count++;
    # Date to dd/mm/yyyy
    $releasedate = new DateTime($row['releasedate']);
    $releasedate_formatted = $releasedate->format('d/m/Y');

    $JSON.='{"gameid":"'.$row['gameid'].'","Release":"'.$releasedate_formatted.'","Title":"'.$row['title'].'","Developers":"'.$row['developer'].'","Platform":"'.$row['platform'].'"}';
    if($count<$rows) $JSON.=",";
}
# Close JSON file
$JSON .= ']}';

# Write to JSON
$handler = fopen("data.json", "w");
fwrite($handler, $JSON);
fclose($handler);
?>