<?php
include("connect.php");

$query = "SELECT usergameid, title, releasedate, developer, platform FROM usergames";
$stmt = $yhteys->prepare($query);
$stmt->execute();

# Save to JSON file
$JSON='{"games":[';
$count = 0;
$rows = $stmt->rowCount();

# Iterate rows and append to JSON 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $count++;
    # Date to dd/mm/yyyy
    $releasedate = new DateTime($row['releasedate']);
    $releasedate_formatted = $releasedate->format('d/m/Y');

    $JSON.='{"usergameid":"'.$row['usergameid'].'","Release":"'.$releasedate_formatted.'","Title":"'.$row['title'].'","Developers":"'.$row['developer'].'","Platform":"'.$row['platform'].'"}';
    if($count<$rows) $JSON.=",";
}
# Close JSON file
$JSON .= ']}';

# Write to JSON
$handler = fopen("data2.json", "w");
fwrite($handler, $JSON);
fclose($handler);

?>
