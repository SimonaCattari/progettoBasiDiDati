<?php

require_once('connessione.php');
session_start();
 $id_blog=$_GET['id'];
 $_SESSION['id_blog'] = $id_blog;

 //form per la modifica del coautore, laddove esistente
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
                <a id="logo" href="index.php"> Blog </a>

                <div class="inputbox">
                    <input type="button" value="Home" onclick="location.href='index.php'">
                  </div>
            </div>

            <section class="blog">

            <?php echo "<form action='update_coautore.php?id=$id_blog' method='POST' id='crea' enctype='multipart/form-data'>"; ?>
                <?php
                                        
                                            $sql1="SELECT nome FROM utente_log WHERE id_utente = ( SELECT id_user FROM coautore WHERE id_blog = '$id_blog')";
                                            $result1 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));
                                            $row1 = $result1->fetch_assoc();
                                            
                                            if ($result1->num_rows == 0)
                                            {
                                                echo "<div class='inputbox'>
                    
                                                <input list='list-coautore' name='nome_coautore'  placeholder='Seleziona il coautore' >
                            
                                                <datalist id='list-coautore'>";
                    
                                            }
                                            else{
                        
                                                $coautore = $row1['nome'];
                        
                                                echo "<div class='inputbox'>
                    
                                                <input list='list-coautore' name='nome_coautore'  placeholder='$coautore' >
                            
                                                <datalist id='list-coautore'>";
                        
                                            }
                    
                                            $sql="SELECT nome FROM utente_log";
                                            $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                    
                                            if ($result->num_rows > 0)
                                            {
                                                    while($row = $result->fetch_assoc())    
                                                    {
                                                            $nome=$row["nome"];
                                                            echo (" <option value='$nome'>");;
                                                    }
                    
                                            }
                                            else
                                            {
                                                echo("");
                                            } 
                    
                                            mysqli_free_result($result); 
                                            
                                            echo"</datalist>
                                            </div>";
                    
                                        
                    ?>


                    <div class="inputbox">

                        <input type="submit" id="posta-blog" value="imposta">

                    </div>

                    </form>


            </section>

            <div class="elenco">
                
            </div>
            <div class="elenco2">
                

            </div>
    </body>
    </html>
