<?php

require_once('connessione.php');
session_start();

//file per la visualizzazione dei blog che hanno come tema il tema selezionato dall'utente

?>
<!DOCTYPE html>
<html>
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                    <title>home</title>

                <meta name="viewport" content="width=device-width">
                <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script type="text/javascript" src="commenti.js"></script>

            <link rel="stylesheet" href="stile1.css">

    </head>

    <body id="b">

        <div class="elenco" id='searchresult'></div>
        <div class="elenco2"></div>
        <div class="menu">
            <a id="logo" href="index.php"> Blog </a>

            <div class='inputbox'>
                <input type='button' value='HOME' onclick="location.href='index.php'">
            </div>
        </div>

        <section class="blog">


            <section  >
            <?php
            $id = $_GET['id'];
                $sql="SELECT * FROM blog WHERE id_tema = '$id'";
                $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                if ($result->num_rows > 0)
                {
                    $sql1="SELECT * FROM tema WHERE id_tema = '$id' ";
                    $result2 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));
                    $row2 = $result2->fetch_assoc();
                    $nome_tema=$row2["nome"];

                    echo(">
                    <a id='logo' > -- ECCO I BLOG CON IL TEMA $nome_tema!-- </a> ");
                        $i = 0;
                        while($i != 9 && $row = $result->fetch_assoc())
                        {
                                $nome=$row["nome"];
                                $id_utente=$row["id_user"];
                                $id_blog=$row["id_blog"];
                                $id_grafica=$row["id_grafica"];

                                $sql4="SELECT nome FROM utente_log WHERE id_utente='$id_utente'";
                                $result4 = mysqli_query( $conn,$sql4) or die("Errore database:". mysqli_error($conn));
                                    $row4 = $result4->fetch_assoc();
                                    $nome_utente=$row4['nome'];
                                


                                $sql2="SELECT sfondo FROM grafica WHERE id_grafica='$id_grafica'";
                                $result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                                if($result1->num_rows > 0) {
                                    $row1 = $result1->fetch_assoc();
                                    $img=$row1['sfondo'];
                                }

                                
                                if($id_utente == $id)
                                {
                                   echo (" <article id='blog'>
                                   
                                   <button> <a href = 'modifica_blog.php?id=$id_blog'><img id='ope1'src='modifica.png'> </img></a></button>
                                    <button onclick='elimina($id_blog)'><img src='elimina.png' id='ope'></img></button><a href='visualizza_blog.php?id_blog=$id_blog' id='logo'> &nbsp $nome</a><br>UTENTE:<a href='profilo_utente.php?id=$id_utente'> $nome_utente <br><br>
                                    ");

                                    if($row1['sfondo'] != null){
                                        echo "<img src='sfondi/$img' id='sfondo'> </img>
                                                                       
                                        </article>";
                                    }
                                    else{
                                        echo "</article>";
                                    }
                                }
                                else
                                {

                                   echo" <article id='blog'>
                                            <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp  $nome </a><br>UTENTE:<a href='profilo_utente.php?id=$id_utente'> $nome_utente <br><br><br></a>
                                            ";

                                            if($row1['sfondo'] != null){
                                                echo "<img src='sfondi/$img' id='sfondo'> </img>
                                                                               
                                                </article>";
                                            }
                                            else{
                                                echo "</article>";
                                            }

                                }

                                $i++;
                        }

                }
                else
                {
                    echo("<article class='post'>
                    <a id='logo' > -- NON CI SONO ANCORA POST CON QUESTO TEMA!-- </a> </article>");
                }

                mysqli_free_result($result);

            ?>

        </section>

    </body>
</html>