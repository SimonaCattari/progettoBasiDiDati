<?php
//connessione al db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "progetto";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

if (!$conn){
    die ('Non riesco a connettermi: ' . mysql_error());
}

?>
