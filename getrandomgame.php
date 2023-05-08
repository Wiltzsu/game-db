<?php

include "connect.php";

// Check if file exists and readable
include('gamelisting.php');
if(file_exists("data.json") && is_readable("data.json")) {
  $json_data = file_get_contents("data.json");
  $data = json_decode($json_data, true);
}

// Check if "games" array exists in data
if(isset($data['games']) && is_array($data['games'])) {
  $games = $data['games'];
  
  $random_index = array_rand($games);
  $random_game = $games[$random_index];

  header('Content-Type: application/json');
  echo json_encode($random_game);
} else {
  // Output a message if no games found
  echo "No games found";
}
?>
