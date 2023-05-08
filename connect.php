<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$palvelin = "localhost";
$tietokanta = "gamedb";
$tunnus = "root";
$salasana = "";

$yhteys = new PDO("mysql:host=$palvelin;dbname=$tietokanta", $tunnus, $salasana);
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*if($yhteys == true) {
    echo "Yhteys on muodostettu";
} else {
    echo "Yhteys ei toimi";
}*/

?>