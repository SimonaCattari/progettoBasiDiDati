<?php
session_start();

require_once('connessione.php');
//passaggio delle variabili dal form
$titolo =mysqli_real_escape_string($conn,$_POST['titolo_post']);
$blog = $_POST['nome_blog'];
$data = date("Y-n-j");
$ora = date("H:i");
$testo =mysqli_real_escape_string($conn,$_POST['testo_post']);

$sql="SELECT id_blog FROM blog WHERE nome = '$blog'";
$result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
$row = $result->fetch_assoc();
$id_blog = implode($row);
$id = $_SESSION['id_user'];


//controllo immagine
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


                            
                            header("Location: profilo_blog.php");       
                            
                            
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
           //controllo seconda immagine se esistente
            if (isset($_FILES['file1'])){
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
            
            
                                        
                                        header("Location: profilo_blog.php");       
                                        
                                        
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
                         
                    $sql1="INSERT INTO post(titolo, ora, data, id_blog, id_utente, testo, immagine, immagine1) VALUES ('$titolo', '$ora', '$data', '$id_blog', '$id', '$testo', '$filename', '$filename2')";

                    if($conn->query($sql1)===true)
                        {
                            
                            header("Location: profilo_blog.php");     
                            
                
                        }
                        
                    else
                        {
                            echo "Errore";
                        }      
} 
else{
    $sql1="INSERT INTO post(titolo, ora, data, id_blog, id_utente, testo) VALUES ('$titolo', '$ora', '$data', '$id_blog', '$id', '$testo')";

    if($conn->query($sql1)===true)
        {
            
            header("Location: profilo_blog.php");   
            

        }
        
    else
        {
            echo "Errore";
        }
}
}



$sql2="SELECT id_post FROM post WHERE titolo = '$titolo' AND id_blog = '$id_blog' AND data = '$data'" ;
$result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
$row1 = $result1->fetch_assoc();
$id_post = implode($row1);



$sql3="INSERT INTO reazione(id_post, positivo, negativo) VALUES ('$id_post', '0', '0')";

if($conn->query($sql3)===true)
    {
        echo "Inserito";

    }
    
else
    {
        echo "Errore";
    }



?>