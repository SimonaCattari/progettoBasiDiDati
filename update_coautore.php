<?php
session_start();

//file per la modifica del coautore

require_once('connessione.php');


$coautore = $_POST['nome_coautore'];

$id_blog = $_GET['id'];

    $sql9= "SELECT id_utente FROM utente_log WHERE nome = '$coautore'";
    $resulto = mysqli_query( $conn,$sql9) or die("Errore database:". mysqli_error($conn));
    if ($resulto->num_rows != 0)
    {     
        $row1 = $resulto->fetch_assoc();
        
        $id_c = $row1['id_utente'];
        
        if(isset($row1['id_utente']))
            {
                $sql2="SELECT id_user FROM coautore WHERE id_blog = '$id_blog'";
                $result2 =  mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                if($result2->num_rows == 0)
                {
                    $sql4="INSERT INTO coautore(id_blog, id_user) VALUES ('$id_blog', '$id_c')";
                    if($conn->query($sql4)===true)
                        {
                            echo"";
                
                        }
                    
                }
                else
                {
                    $sql7="UPDATE coautore SET id_user = '$id_c' WHERE id_blog = '$id_blog'";
                    if($conn->query($sql7)===true)
                        {
                            echo"";
                
                        }
                 }

            
    }


    }
    header("Location: visualizza_blog.php?id_blog=$id_blog");
    ?>