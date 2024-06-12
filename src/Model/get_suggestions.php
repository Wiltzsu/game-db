<?php

$term = $_GET['term'];

// Perform database query to get matching titles
$query = "SELECT title FROM games WHERE title = '$term'";
$data = $yhteys->query($query);
$rows = $data->fetchAll(PDO::FETCH_ASSOC);

// Return matching titles as JSON array
echo json_encode(array_column($rows, 'title'));

?>