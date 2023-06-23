<?php
session_start();


require_once('connessione.php');
//passaggio dati 
$id_utente = $_GET['id_utente'];
$id_post = $_GET['id_post'];
$id_blog = $_GET['id'];
$commento = mysqli_real_escape_string($conn,$_POST['commento']);
$data = date("Y-n-j");
$ora = date("H:i");
//inserimento commento
$sql1="INSERT INTO commento(id_post, id_user, testo, data, ora) VALUES  ('$id_post', '$id_utente', '$commento', '$data', '$ora')";
$result1= mysqli_query($conn,$sql1) or die("Errore database:". mysqli_error($conn));

header("location: visualizza_blog.php?id_blog=$id_blog");




?>