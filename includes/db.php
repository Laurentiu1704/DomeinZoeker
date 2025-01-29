<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'domeinwinkel';

$db = mysqli_connect($host, $user, $password, $dbname);


if (!$db) {
    die("Verbinding met de database is mislukt: " . mysqli_connect_error());
}
?>
