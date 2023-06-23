<?php

require_once('connessione.php');
session_start();

//form per la modifica del profilo ovvero per settare e modificare l'immagine profilo e il nome dell'utente

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
            <form action='update_profilo.php' method='POST' id='crea' enctype='multipart/form-data'>
            <div class="inputbox">

<input type="file" id="file-input" accept="image/*" name="file" value="" placeholder="Inserisci la tua immagine">

</div>
                <?php 
                     $id = $_SESSION['id_user'];
                            
                     $sql="SELECT nome FROM utente_log WHERE id_utente = '$id'";
                     $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                     $row = $result->fetch_assoc();
                     $nome = $row['nome'];


                    echo "
                    <div class='inputbox'> <input type='text' name='nome1' value='$nome'> </div>";

                    $sql0="SELECT immagine, nome FROM utente_log WHERE id_utente = '$id'";
                    $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn));
                    $row0 = $result0->fetch_array();
                    $img = $row0['immagine'];
                    $nomeu= $row0['nome'];
                    
                    if($row0['immagine'] != null){

                        echo "<img src='avatar/$img' id='pro-ute' > </img>";
                    }
                    

                ?> 


                    

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
    
        