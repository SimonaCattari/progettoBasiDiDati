<?php
session_start();

//file per l'aggiunta di una reazione non mi piace ad un post, e eventuale cancellazione della reazione mi piace collegata all'utente


require_once('connessione.php');

$id_utente = $_GET['id_utente'];
$id_post = $_GET['id_post'];
$id_blog = $_GET['id'];

$sql1="SELECT id_reazione FROM reazione WHERE id_utente = '$id_utente' AND id_post='$id_post'";
$result1= mysqli_query($conn,$sql1) or die("Errore database:". mysqli_error($conn));

if($result1->num_rows > 0)

{
    $sql2 = "DELETE FROM reazione WHERE id_utente = '$id_utente' AND id_post = '$id_post'";
    $result2 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));

    $sql="INSERT INTO `reazione` (`id_utente`, `id_post`, `negativo`) VALUES ('$id_utente', '$id_post', '1')";

    $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
    header("location: visualizza_blog.php?id_blog=$id_blog");
}
else {

    $sql="INSERT INTO `reazione` (`id_utente`, `id_post`, `negativo`) VALUES ('$id_utente', '$id_post', '1')";
    $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
    header("location: visualizza_blog.php?id_blog=$id_blog");
    
}


?>