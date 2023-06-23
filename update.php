<?php
session_start();

//file per la modifica del post selezionato dall'utente creatore

require_once('connessione.php');

$titolo1 = mysqli_real_escape_string($conn,$_POST['titolo']);
$blog = $_POST['nome_blog'];
$data = date("Y-n-j");
$ora = date("H:i");
$testo = mysqli_real_escape_string($conn,$_POST['testo']);

$sql="SELECT id_blog FROM blog WHERE nome = '$blog'";
$result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
$row = $result->fetch_assoc();
$id_blog = implode($row);
$id = $_SESSION['id_user'];

$titolo = $_GET["a"];
$sql1="SELECT id_post FROM post WHERE titolo = '$titolo'";
$result1 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));
$row1 = $result1->fetch_assoc();
$id_post = implode($row1);

if (isset($_FILES['file'])){
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
                            $path = "img_post";
                            if (!is_dir($path)) {
                                mkdir($path, 0777, true);
                            }
                            $destinazione = 'img_post/'.$filename; 
                            move_uploaded_file($filetmpname, $destinazione);


                            
                            header("Location: visualizza_blog.php?id_blog=$id_blog");     
                            
                            
                    }
                    else
                    {
                        echo "Il tuo file è troppo grande";
                    }
                }
                else
                {
                    echo "Errore nel caricamento";
                }
            }
            else
            {
                echo"Non puoi caricare file con quest'estensione $est_attuale_file";
            }


$sql1="UPDATE post SET titolo='$titolo1', ora='$ora', data='$data', id_blog='$id_blog', id_utente='$id', testo='$testo', immagine='$filename'WHERE id_post='$id_post'";

if($conn->query($sql1)===true)
    {
        
        header("Location: visualizza_blog.php?id_blog=$id_blog");    
        

    }
    
else
    {
        echo "Errore";
    }      

}
elseif (isset($_FILES['file1'])){
    $file1 = $_FILES['file1'];
    
    $filename2 =  $_FILES['file1']['name'];
    $filetmpname =  $_FILES['file1']['tmp_name'];
    $filesize =  $_FILES['file1']['size'];
    $fileerror =  $_FILES['file1']['error'];
    $filetype =  $_FILES['file1']['type'];
    
    $est_file = explode('.', $filename2);
    $est_attuale_file = strtolower(end($est_file));
    
    $estensioni = array('jpg', 'jpeg', 'png', 'gif');
    
            if(in_array($est_attuale_file, $estensioni))
            {
                if ($fileerror === 0)
                {
                    if($filesize < 10000000)
                    {
                            $filename1 = uniqid('', true).".".$est_attuale_file;   
                            $path = "img_post";
                            if (!is_dir($path)) {
                                mkdir($path, 0777, true);
                            }
                            $destinazione = 'img_post/'.$filename2; 
                            move_uploaded_file($filetmpname, $destinazione);


                            
                            header("Location: visualizza_blog.php?id_blog=$id_blog");  
                            
                            
                    }
                    else
                    {
                        echo "Il tuo file è troppo grande";
                    }
                }
                else
                {
                    echo "Errore nel caricamento";
                }
            }
            else
            {
                echo"Non puoi caricare file con quest'estensione $est_attuale_file";
            }
             
        $sql1="UPDATE post SET titolo='$titolo1', ora='$ora', data='$data', id_blog='$id_blog', id_utente='$id', testo='$testo', immagine1='$filename2' WHERE id_post='$id_post'";

        if($conn->query($sql1)===true)
            {
                
                header("Location: visualizza_blog.php?id_blog=$id_blog");   
                
    
            }
            
        else
            {
                echo "Errore";
            }      
}

else{
    $sql2="UPDATE post SET titolo='$titolo1', ora='$ora', data='$data', id_blog='$id_blog', id_utente='$id', testo='$testo' WHERE id_post='$id_post'";
   $result3 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
   header("Location: visualizza_blog.php?id_blog=$id_blog"); 
}





?>