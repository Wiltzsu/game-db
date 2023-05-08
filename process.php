<?php
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = $_POST['id'];
    if ($action == 'update') {
        if(isset($_GET['title'])) {
            $title = $_GET['title'];
            $releasedate = $_POST['releasedate'];
            $developer = $_POST['developer'];
            $platform = $_POST['platform'];
            
            $kysely = "UPDATE games SET releasedate=:releasedate, developer=:developer, platform=:platform WHERE title=:title";
            $update = $yhteys->prepare($kysely);
            $update->bindValue(':title', $title, PDO::PARAM_STR);
            $update->bindValue(':releasedate', $releasedate, PDO::PARAM_STR);
            $update->bindValue(':developer', $developer, PDO::PARAM_STR);
            $update->bindValue(':platform', $platform, PDO::PARAM_STR);
            $update->execute();
        }
        
        header("Location: admin.php?title=" . urlencode($title));
        
    } elseif ($action == 'delete') {
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
        header("Location: admin.php?title=" . urlencode($title));
    }
  }
  
?>