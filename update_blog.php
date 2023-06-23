<?php
session_start();

//file per la modifica del blog

require_once('connessione.php');

$nome = mysqli_real_escape_string($conn,$_POST['nome_blog']);
$sottotema = mysqli_real_escape_string($conn,$_POST['sottottema']);
$font = $_POST['font'];
$colore = $_POST['colore'];
$coautore = $_POST['nome_coautore'];
$tema = $_POST['tema']; 
$id = $_SESSION['id_user'];
$id_blog=$_SESSION['id_blog'];

$sql0="SELECT id_grafica FROM blog WHERE id_blog='$id_blog'";
$result0 = mysqli_query( $conn,$sql0) or die("Errore database:". mysqli_error($conn));
$row0 = $result0->fetch_assoc();
$id_grafica = implode($row0);

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
                $path = "sfondi";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $destinazione = 'sfondi/'.$filename; 
                move_uploaded_file($filetmpname, $destinazione);
                $sql1="UPDATE grafica SET sfondo ='$filename' WHERE id_grafica = '$id_grafica'";
                if($conn->query($sql1)===true)
                {
                    header("Location: visualizza_blog.php?id_blog=$id_blog");
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

if(isset($font))
{
    $sql1="UPDATE grafica SET font ='$font' WHERE id_grafica = '$id_grafica'";
    if($conn->query($sql1)===true)
    {
        echo"";
    }
    
}

if(isset($colore) && $colore != '#9b8c8c')
{
    $sql10="UPDATE grafica SET colore_font ='$colore' WHERE id_grafica = '$id_grafica'";
    if($conn->query($sql10)===true)
    {
        echo"";
    }
}



$sql3="SELECT id_tema FROM tema WHERE nome = '$tema'";
$result3 = mysqli_query( $conn,$sql3) or die("Errore database:". mysqli_error($conn));

if($result3->num_rows > 0)
{
    $row2 = $result3->fetch_assoc();
    $id_tema = implode($row2);

}

$sql5="UPDATE blog SET nome ='$nome',  id_tema = '$id_tema' WHERE id_blog = '$id_blog'";
$result1 =  mysqli_query( $conn,$sql5) or die("Errore database:". mysqli_error($conn));



if(isset($sottotema))
    {
        $sql8="UPDATE sottotema SET nome = '$sottotema', id_tema = '$id_tema' WHERE id_blog = '$id'";
    }

    header("Location: visualizza_blog.php?id_blog=$id_blog");
?>