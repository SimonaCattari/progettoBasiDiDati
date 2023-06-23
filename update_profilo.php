<?php
session_start();

//file per la modifica del profilo utente

require_once('connessione.php');

$nome = mysqli_real_escape_string($conn,$_POST['nome1']);

$id = $_SESSION['id_user'];

if(isset($_FILES['file']))
{
    $file = $_FILES['file'];

$filename =  $_FILES['file']['name'];
$filetmpname =  $_FILES['file']['tmp_name'];
$filesize =  $_FILES['file']['size'];
$fileerror =  $_FILES['file']['error'];
$filetype =  $_FILES['file']['type'];

$est_file = explode('.', $filename);
$est_attuale_file = strtolower(end($est_file));

$estensioni = array('jpg', 'jpeg', 'png', 'gif');

if(in_array($est_attuale_file, $estensioni))
{
    if ($fileerror === 0)
    {
        if($filesize < 10000000)
        {
                $filename1 = uniqid('', true).".".$est_attuale_file;   
                $path = "avatar";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $destinazione = 'avatar/'.$filename; 
                move_uploaded_file($filetmpname, $destinazione);      
                $sql1="UPDATE utente_log SET immagine ='$filename' WHERE id_utente = '$id'";
                if($conn->query($sql1)===true)
                {
                    header("Location: profilo_blog.php");
                }
                
                
        }
        else
        {
            echo '<script> alert("Non puoi caricare file con questa dimensione")</script>';
        }
    }
    else
    {
        echo '<script> alert("Errore nel caricamento")</script>';
    }
}
else
{
    echo'<script> alert("Non puoi caricare file con questa estensione")</script>';

}
}
    
   $sql2="UPDATE utente_log SET nome='$nome' WHERE id_utente='$id'";
   $result3 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));

 header("Location: profilo_blog.php");   




?>