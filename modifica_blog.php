<?php

require_once('connessione.php');
session_start();
 $id_blog=$_GET['id'];
 $_SESSION['id_blog'] = $id_blog;

 //form per la modifica del blog. Il form si presenta già completo dei campi del blog da modificare
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

            <form action='update_blog.php' method='POST' id='crea' enctype="multipart/form-data">
                <?php
                    
                    echo "
                
                    <div class='inputbox' id='file-input'>

                        <p id='immagine'> Seleziona l'immagine di copertina del blog: </p>
                        <input type='file' id='file-input-blog' name='file' value='' placeholder='Inserisci l'immagine del blog'>

                    </div>";

                ?>
                    <div class="inputbox">

                    <?php
            
                    $_SESSION['id_blog'] = $id_blog;
                    $sql="SELECT nome, id_user FROM blog WHERE id_blog = '$id_blog'";
                    $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                    $row = $result->fetch_assoc();
                    $nome = $row["nome"];
                    $id = $row["id_user"];


                    echo "<input type='text' name='nome_blog' required='required' value = '$nome'";
                    
                    ?>

                    </div>


                


                    <div class="inputbox">

                        <input list="list-tema" name="tema" required="required" placeholder="Seleziona il tema" >

                        <datalist id="list-tema">
                        <?php

                            $sql="SELECT nome FROM tema";
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
                                echo("apos");
                            } 

                            mysqli_free_result($result); 

                         ?>

                        </datalist>
                    </div>

                    <?php
                    
                
                    $sql3="SELECT nome FROM sottotema WHERE id_blog = '$id_blog'";
                    $result3 = mysqli_query( $conn,$sql3) or die("Errore database:". mysqli_error($conn));
                    $row3 = $result3->fetch_assoc();



                    if ($result3->num_rows == 0)
                    {
                        echo "<div class='inputbox'>

                            <input type='text' name='sottotema'  placeholder='Nessun sottotema' >

                        </div>";
                    }
                    else{

                        $nome_s = $row3['nome'];

                        echo "<div class='inputbox'>

                        <input type='text' name='sottotema' value = '$nome_s '>

                         </div>";

                    }
                    
                    

                    
                    ?>

                   

                    <div class="inputbox">

                        <input list="list-font"  required="required" name="font" placeholder="Seleziona il font" >

                        <datalist id="list-font"> 

                               <option value='Default'>
                               <option value='Times New Roman'>
                               <option value='Roboto'>
                               <option value='Comic Sans MS'>
                               <option value='Courier'>
            
                        </datalist>
                    </div>

                    <?php
                    
                    $sql0="SELECT id_grafica FROM blog WHERE id_blog='$id_blog'";
                    $result0 = mysqli_query( $conn,$sql0) or die("Errore database:". mysqli_error($conn));
                    $row0 = $result0->fetch_assoc();
                    $id_grafica = implode($row0);

                    $sql2="SELECT colore_font FROM grafica WHERE id_grafica = '$id_grafica'";
                    $result2 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                    $row2 = $result2->fetch_assoc();
                    $colore = $row2['colore_font'];

                        echo "<div class='inputbox'>
                        
                        <p id = 'colore'>Seleziona il colore:</p>
                        <input type='color' name='colore' value='$colore' id='blog_color'>

                         </div>";
                    
                    ?>


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