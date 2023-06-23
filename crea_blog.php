<?php
//presentazione del form per la creazione di un blog da parte di un utente registrato

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
            <a id="logo" > Blog </a>
            <div class="inputbox">
                <input type="button" value="Home" onclick="location.href='index.php'">
            </div>
        </div>

        <section class="blog">
            <form action="creazione_blog1.php" method="POST" id="crea" enctype="multipart/form-data">
                <div class="inputbox" id="file-input"> 
                    <p id="immagine"> Seleziona l'immagine di copertina del blog: </p>
                    <input type="file" accept="image/*" id="file-input-blog" name="file"   placeholder="Inserisci l'immagine del blog">
                </div>

                <div class="inputbox">
                    <input type="text" name="nome_blog" required="required" placeholder="Inserisci il nome del blog">
                 </div>
                 
                 <?php
                    echo "<div class='inputbox'>
                            <input list='list-coautore' name='nome_coautore'  placeholder='Seleziona il coautore' 
                                 <datalist id='list-coautore'>";
                    
                                    $sql="SELECT nome FROM utente_log"; //lista di nomi degli utenti registrati
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
                        <input list="list-tema" name="tema" required="required" placeholder="Seleziona il tema" >

                        <datalist id="list-tema">
                        <?php

                            $sql="SELECT nome FROM tema"; //lista dei temi disponibili
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

                         ?>

                        </datalist>
                    </div>

                    <div class="inputbox">

                        <input type="text" name="sottotema"  placeholder="Inserisci il sottotema del blog">

                    </div>

                    <div class="inputbox">

                        <input list="list-font" name="font"  placeholder="Seleziona il font" >

                        <datalist id="list-font"> 

                               <option value='Default'>
                               <option value='Times New Roman'>
                               <option value='Roboto'>
                               <option value='Comic Sans MS'>
                               <option value='Courier'>
            
                        </datalist>
                    </div>

                    
                    <div class="inputbox">

                        <p id = "colore">Seleziona il colore:</p>
                        <input type="color"  id="blog_color" name="colore" >

                    </div>


                    <div class="inputbox">

                        <input type="submit" id="posta-blog" value="Posta">

                    </div>

                    </form>


            </section>

            <div class="elenco">
                
            </div>
            <div class="elenco2">
                

            </div>
    </body>
</html>
    
        