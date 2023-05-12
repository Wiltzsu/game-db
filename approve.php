<?php

require "connect.php";

if(isset($_GET['usergameid'])) {
    $usergameid = $_GET['usergameid'];

    // Retrieve game information from usergames table
    $stmt = $yhteys->prepare("SELECT * FROM usergames WHERE usergameid = :usergameid");
    $stmt->bindValue(':usergameid', $usergameid, PDO::PARAM_STR);
    $stmt->execute();
    $game = $stmt->fetch();

    // Insert game information into games table
    $add = $yhteys->prepare("INSERT INTO games(title, releasedate, developer, platform) VALUES(:title, :releasedate, :developer, :platform)");
    $add->bindValue(':title', $game['title'], PDO::PARAM_STR);
    $add->bindValue(':releasedate', $game['releasedate'], PDO::PARAM_STR);
    $add->bindValue(':developer', $game['developer'], PDO::PARAM_STR);
    $add->bindValue(':platform', $game['platform'], PDO::PARAM_STR);
    $add->execute();

    // Delete game information from usergames table
    $del = $yhteys->prepare("DELETE FROM usergames WHERE usergameid=:usergameid");
    $del->bindValue(':usergameid', $usergameid, PDO::PARAM_STR);
    $del->execute();
}

echo "<script>window.location.replace('admin.php?usergameadded=true');</script>";

?>
