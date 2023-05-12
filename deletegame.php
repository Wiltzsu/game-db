<?php

require "connect.php";

if(isset($_POST['title'])) {
    $title = $_POST['title'];
    $kysely = "DELETE FROM games WHERE title=:title";
    $poista = $yhteys->prepare($kysely);
    $poista->bindValue(':title', $title, PDO::PARAM_STR);
    $poista->execute();
}
else if(isset($_POST['usergameid'])) {
    $usergameid = $_POST['usergameid'];
    $kysely = "DELETE FROM usergames WHERE usergameid=:usergameid";
    $poista = $yhteys->prepare($kysely);
    $poista->bindValue(':usergameid', $usergameid, PDO::PARAM_STR);
    $poista->execute();
}

echo "<script>window.location.replace('admin.php?usergamedeleted=true');</script>";

?>