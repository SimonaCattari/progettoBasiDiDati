<?php

require_once('connessione.php');
session_start();

//file per la visualizzazione del post cercato dall'utente


?>
<!DOCTYPE html>
<html>

    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                    <title>profilo</title>

                <meta name="viewport" content="width=device-width">
                <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script type="text/javascript" src="commenti.js"></script>

            <link rel="stylesheet" href="stile1.css">

    </head>

    <body id="b">
            <div class="menu">

                <a id="logo" href="index.php"> Blog </a>

                <div class='inputbox'>

                <input type='button' value='HOME' onclick="location.href='index.php'">

                </div>

            </div>

            <section class="blog" id='profilo_blog'>

                <a> <br><br><br><br><br><br><br><br><br></a>

                <?php
                $id = $_GET['id'];


                $sql="SELECT titolo FROM post WHERE id_post = '$id'";
                $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));

                    $id_utente = $_SESSION['id_user'];
                if ($result->num_rows > 0)
                {
                        while($row = $result->fetch_assoc())
                        {
                            $titolo=$row["titolo"];
                            $sql3="SELECT id_post, testo, immagine, data, immagine1 FROM post WHERE titolo = '$titolo'";
                                $result3 = mysqli_query( $conn,$sql3) or die("Errore database:". mysqli_error($conn));
                                $row3 = $result3->fetch_assoc();
                                $id_post = $row3['id_post'];
                                $testo_post = $row3['testo'];
                                $img1 = $row3['immagine'];
                                $img2 = $row3['immagine1'];
                                $data1 = $row3['data'];

                                if($row3['immagine'] != null)
                                {

                                    if($row3['immagine1'] != null)
                                    {

                                    echo ("


                                        <article class='post'>

                                         <button> <a href = 'modifica.php?t=$titolo'><img id='ope1'src='modifica.png'> </img></a></button>
                                         <button>  <a href='elimina_post.php?id=$id_post'><img id='ope1'src='elimina.png'> </img></a></button>

                                            <a id='logo' > $titolo <br> $testo_post <br></a>
                                            <img id='img-post' src='img_post/$img2'>
                                            <img id='img-post'src='img_post/$img1'> <br> <a> Data Pubblicazione: $data1<a></img>
                                        <div id='commenti'>
                                        ");
                                    }
                                    else
                                    {
                                        echo ("


                                        <article class='post'>

                                         <button> <a href = 'modifica.php?t=$titolo'><img id='ope1'src='modifica.png'> </img></a></button>
                                         <button>  <a href='elimina_post.php?id=$id_post'><img id='ope1'src='elimina.png'> </img></a></button>
                                            <a id='logo' > $titolo <br> $testo_post <br></a>
                                            <img id='img-post'src='img_post/$img1'> <br> <a> Data Pubblicazione: $data1<a></img>
                                        <div id='commenti'>
                                        ");
                                    }

                                }
                                else
                                {
                                    echo ("

                                    <article class='post'>
                                            <button> <a href = 'modifica.php?t=$titolo'><img id='ope1'src='modifica.png'> </img></a></button>
                                            <button>  <a href='elimina_post.php?id=$id_post'><img id='ope1'src='elimina.png'> </img></a></button>
                                        <a id='logo' > $titolo <br> $testo_post <br> Data Pubblicazione: $data1 </a>
                                        <div id='commenti'>

                                    ");
                                }


                                        $sql19="SELECT testo, id_user, data, ora FROM commento WHERE id_post = '$id_post'";
                                        $result19 = mysqli_query( $conn,$sql19) or die('Errore database:'. mysqli_error($conn));
                                        if($result19->num_rows > 0)
                                                    {
                                                            while($row19 = $result19->fetch_assoc())
                                                            {

                                                                    $testo = $row19['testo'];
                                                                    $data = $row19['data'];
                                                                    $ora = $row19['ora'];
                                                                    $id_user = $row19['id_user'];

                                                                    $sql2="SELECT nome FROM utente_log WHERE id_utente = '$id_user'";
                                                                    $result2 = mysqli_query($conn, $sql2) or die("Errore database". mysqli_error($conn));
                                                                    $row2 = $result2->fetch_assoc();
                                                                    $nome = $row2['nome'];

                                                                    echo "<article id='c'>
                                                                    <a id='c1'> $nome: &nbsp&nbsp $testo &nbsp&nbsp $data &nbsp&nbsp $ora &nbsp&nbsp<br><br></a>
                                                                    </article>";

                                                            }
                                                    }
                                                    else {
                                                        echo'ANCORA NESSUN COMMENTO';
                                                    }
                                         echo ("
                                        </div></img></article><div class='commentobox'>


                                        <form action='commenti.php?id_utente=$id_utente&id_post=$id_post&id=$id' method='POST'>
                                        <input type='text'  name='commento'  placeholder='Scrivi il tuo commento'>
                                        <button type='submit' id='commenta' value='Pubblica'> Pubblica</button>
                                    </form>
                                   </div>");



                                $sql3="SELECT id_post FROM post WHERE titolo = '$titolo'";
                                $result3 = mysqli_query( $conn,$sql3) or die("Errore database:". mysqli_error($conn));
                                $row3 = $result3->fetch_assoc();
                                $id_post = $row3['id_post'];

                                $sql1="SELECT SUM(positivo) as positivo, SUM(negativo) as negativo FROM reazione WHERE id_post = '$id_post'";
                                $result1 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));

                                if ($result1->num_rows > 0)
                                {
                                        while($row && $row1 = $result1->fetch_assoc())
                                        {
                                                $positivo=$row1['positivo'];
                                                $negativo=$row1["negativo"];
                                                echo ("
                                                        <article class='reaction'>
                                                            <div class='reazione1'>
                                                                <a  href='mi_piace.php?id_utente=$id_utente&id_post=$id_post&id=$id' > $positivo MI PIACE</a>
                                                            </div>
                                                            <div class='reazione2'>
                                                                <a href='non_mipiace.php?id_utente=$id_utente&id_post=$id_post&id=$id' > $negativo  NON MI PIACE</a>
                                                            </div>
                                                        </article>

                                                        ");
                                        }

                                }
                                else
                                {
                                    echo("");
                                }
                            }
                        }

                mysqli_free_result($result);

            ?>
            </section>
