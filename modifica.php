<?php
//visualizzazione del form per la modifica di un post. 
//vengono già presentati i campi laddove completi 
require_once('connessione.php');
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                    <title>home</title>

                <meta name="viewport" content="width=device-width">
                <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>

            <link rel="stylesheet" href="stile1.css">

    </head>

    <body id="b">
            <div class="menu">
                <a id="logo"> Blog </a>

                <div class="inputbox">
                    <input type="button" value="Home" onclick="location.href='index.php'">
                  </div>
            </div>

            <section class="blog">
                <?php 
                
                    $a=$_GET['t'];

                    echo "<form action='update.php?a=$a' method='POST' id='crea' enctype='multipart/form-data'>
                    <div class='inputbox'> <input type='text' name='titolo' value='$a'> </div>"

                ?> 
                    <div class="inputbox">

                        <input list="list-blog" name="nome_blog" required="required" placeholder="Seleziona il blog" >

                        <datalist id="list-blog">
                        <?php

                            $id = $_SESSION['id_user'];
                            
                            $sql="SELECT nome FROM blog WHERE id_user = '$id'";
                            $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));

                            if ($result->num_rows > 0)
                            {
                                    $i = 0;
                                    while($i != 9 && $row = $result->fetch_assoc())    
                                    {
                                            $nome=$row["nome"];
                                            echo (" <option value='$nome'>");

                                            $i++;
                                    }

                            }
                            else
                            {
                                echo("");
                            } 


                            $sql1="SELECT nome FROM blog WHERE id_blog IN (SELECT id_blog FROM coautore WHERE id_user = '$id')";
                            $result1 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));

                            if ($result1->num_rows > 0)
                            {
                                    $i = 0;
                                    while($i != 9 && $row = $result1->fetch_assoc())    
                                    {
                                            $nome=$row["nome"];
                                            echo (" <option value='$nome'>");

                                            $i++;
                                    }

                            }
                            else
                            {
                                echo("");
                            } 

                            mysqli_free_result($result1); 
                            mysqli_free_result($result); 

                        ?> 

                        </datalist>
                    </div>

                    <div class="inputbox">

                        <?php 
                            $a=$_GET['t'];
                            $sql="SELECT testo FROM post WHERE titolo='$a'";
                            $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                            $row = $result->fetch_assoc();
                            $testo = $row["testo"];

                            echo "<textarea id='post-text' name='testo'> $testo</textarea>";
                        ?>

                    </div>
                    
                    
                    <?php 
                            $a=$_GET['t'];
                            $sql2="SELECT immagine, immagine1 FROM post WHERE titolo='$a'";
                            $result2 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                            $row2 = $result2->fetch_assoc();
                            $img = $row2["immagine"];
                            $img1 = $row2["immagine1"];
                            
                            if($row2["immagine"] != null)
                            {
                                if($row2["immagine1"] != null)
                                {
                                    echo "<div id='post-mod'><img id='img-post' src='img_post/$img'> </img>
                                    ";
                                    echo "<img id='img-post' src='img_post/$img1'> </img>
                                    </div>";

                                    echo"<div class='inputbox'>

                                <input type='file' id='file-input' name='file' value='' placeholder='Inserisci la tua immagine'>
                                <input type='file' id='' name='file1' value='' placeholder='Inserisci la tua immagine'>
                                
                            </div>";


                                }
                                else
                                {
                                    echo "<div id='post-mod'><img id='img-post' src='img_post/$img'> </img>
                                    ";
                            echo"<div class='inputbox'>

                                    <input type='file' id='file-input' name='file' value='' placeholder='Inserisci la tua immagine'>
                                    <input type='file' id='' name='file1' value='' placeholder='Inserisci la tua immagine'>
                                    
                                </div>";
                                }
                            }
                            else
                            {
                                echo"<div class='inputbox'>

                                <input type='file' id='file-input' name='file' value='' placeholder='Inserisci la tua immagine'>
                                <input type='file' id='' name='file1' value='' placeholder='Inserisci la tua immagine'>
                                
                            </div>";

                            }
                            
                        ?>
                    </div>
                    



                    <div class="inputbox">

                        <input type="submit"  value="Modifica">

                    </div>

                    </form>


            </section>

            <div class="elenco">
                
            </div>
            <div class="elenco2">
                

            </div>
    </body>
</html>
    
        