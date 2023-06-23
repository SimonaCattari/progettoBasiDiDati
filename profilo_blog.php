<?php

require_once('connessione.php');
session_start();

//file per la visualizzazione e la modifica di tutto ciò che riguarda l'utente


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

                <a id="logo" href="index.php"> Blog </a>  <!--link all'index-->

                <div class='inputbox'>

                <input type='button' value='Crea blog' onclick="location.href='crea_blog.php'"> <!--bottone per creare un nuovo blog-->

                </div>

            </div>

            <section class="blog" id='profilo_blog'>

                <div class ="profilo">
                    <div class ="imgprofilo">
                        <?php

                            $id = $_SESSION['id_user'];


                            //estrazione immagine del profilo
                            $sql0="SELECT immagine, nome FROM utente_log WHERE id_utente = '$id'";
                            $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn));
                            $row0 = $result0->fetch_array();
                            $img = $row0['immagine'];
                            $nomeu= $row0['nome'];


                            if($row0['immagine'] != null)
                            {   //se esiste si fa vedere
                                echo "<img src='avatar/$img' id='profilo' > </img>";

                                //bottone del logout
                            echo("<form method='post' action='logout.php?id_user=$id'>
                            <input type='submit' name='esegui' value='Logout $nomeu'/>
                          </form>");
                                //bottone elimina e modifica profilo
                          echo("<button> <a href = 'modifica_profilo.php'><img id='ope1'src='modifica.png'> </img></a></button>
                          <button>  <a href='elimina_profilo.php?id=$id'><img id='ope1'src='elimina.png'> </img></a></button>
                          ");
                            }
                            else{ //se non esiste si fa vedere solo il bottone del logout, modifica ed elimina profilo

                          echo("<form method='post' action='logout.php?id_user=$id'>
                            <input type='submit' name='esegui' value='Logout $nomeu'/>
                          </form>");
                                echo("
                                <button>  <a href='elimina_profilo.php?id=$id'><img id='ope1'src='elimina.png'> </img></a></button>
                                <button> <a href = 'modifica_profilo.php'><img id='ope1'src='modifica.png'> MODIFICA IL PROFILO PER INSERIRE L'IMMAGINE </img></a></button>
                                ");

                            }



                        ?>

                    </div>
                </div>

                <?php
                $id = $_SESSION['id_user'];
                $sql="SELECT nome, id_user, id_blog, id_grafica FROM blog WHERE id_user = '$id' "; //si estraggono i blog dell'utente
                $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                if ($result->num_rows > 0)
                {
                        $i = 0;
                        while($i != 9 && $row = $result->fetch_assoc()) //finchè  ci sono risultati
                        {
                                $nome=$row["nome"];
                                $id_utente=$row["id_user"];
                                $id_blog=$row["id_blog"];
                                $id_grafica=$row["id_grafica"];

                                $sql4="SELECT nome FROM utente_log WHERE id_utente='$id_utente'"; //si estrae il nome dell'utente
                                $result4 = mysqli_query( $conn,$sql4) or die("Errore database:". mysqli_error($conn));
                                    $row4 = $result4->fetch_assoc();
                                    $nome_utente=$row4['nome'];



                                $sql2="SELECT sfondo FROM grafica WHERE id_grafica='$id_grafica'"; //lo sfondo che ha scelto
                                $result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                                if($result1->num_rows > 0) {
                                    $row1 = $result1->fetch_assoc();
                                    $img=$row1['sfondo'];
                                }

                                if($row1['sfondo'] != null){  //se lo sfondo è diverso da null --> bottone modifica, elimia, visualizza e l'immagine
                                    echo (" <article id='blog'>

                                    
                                    <button> <a href = 'modifica_blog.php?id=$id_blog'><img id='ope1'src='modifica.png'> </img></a></button>
                                    <button>  <a href='elimina_blog.php?id=$id_blog'><img id='ope1'src='elimina.png'> </img></a></button>
                                    <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>
                                    <img src='sfondi/$img' id='sfondo'> </img>

                                     </article>");

                                }
                                else{ // se è nullo, solo il bottone modifica ed elimina
                                    echo (" <article id='blog'>

                                    <button> <a href = 'modifica_blog.php?id=$id_blog'><img id='ope1'src='modifica.png'> </img></a></button>
                                    <button>  <a href='elimina_blog.php?id=$id_blog'><img id='ope1'src='elimina.png'> </img></a></button><a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>


                                     </article>");
                                }




                                $i++;
                        }

                }
                else //se non ci sono blog presenti
                {
                    echo(" <article class='post'>
                    <a id='logo' > -- NON CI SONO ANCORA BLOG NEL TUO PROFILO!-- </a><a href='crea_blog.php'> CREANE UNO!</a> </article>");
                }

                // libera la memoria una volta che sono stati estrapolati tutti i record
                mysqli_free_result($result);

            ?>
            </section>

            <section class="blog" id='coautore_blog'>

            <div class ="profilo">
                    <div class ="imgprofilo">
                        <?php

                            $id = $_SESSION['id_user'];

                            //Foto, nome, logout, modifica ed elimina blog dell'autore che ha effettuato l'accesso

                            $sql0="SELECT immagine FROM utente_log WHERE id_utente = '$id'";
                            $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn));
                            $row0 = $result0->fetch_array();
                            $img = $row0['immagine'];

                            if($row0['immagine'] != null)
                            {
                                echo "<img src='avatar/$img' id='profilo' > </img>";


                            echo("<form method='post' action='logout.php?id_user=$id'>
                            <input type='submit' name='esegui' value='LOGOUT $nomeu'/>
                          </form>");

                          echo("<button> <a href = 'modifica_profilo.php'><img id='ope1'src='modifica.png'> </img></a></button>
                          <button>  <a href='elimina_profilo.php?id=$id'><img id='ope1'src='elimina.png'> </img></a></button>
                          ");
                            }
                            else{

                          echo("<form method='post' action='logout.php?id_user=$id'>
                            <input type='submit' name='esegui' value='LOGOUT $nomeu'/>
                          </form>");
                                echo("
                                <button>  <a href='elimina_profilo.php?id=$id'><img id='ope1'src='elimina.png'> </img></a></button>
                                <button> <a href = 'modifica_profilo.php'><img id='ope1'src='modifica.png'> MODIFICA IL PROFILO PER INSERIRE L'IMMAGINE </img></a></button>
                                ");

                            }


                        ?>

                    </div>
                </div>

                <?php
                    $id = $_SESSION['id_user'];

                    //si estraggono i blog in cui l'utente è coautore
                    $sql="SELECT nome, id_blog, id_grafica, id_user FROM blog WHERE id_blog IN (SELECT id_blog FROM coautore WHERE id_user = '$id')";
                    $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));

                    if ($result->num_rows > 0)
                    {
                            $i = 0;
                            while($i != 9 && $row = $result->fetch_assoc())
                            {
                                    $nome=$row["nome"];
                                    $id_blog=$row["id_blog"];
                                    $id_creatore=$row["id_user"];
                                    $id_grafica=$row["id_grafica"];

                                    $sql4="SELECT nome FROM utente_log WHERE id_utente='$id_creatore'"; //il nome dell'utente creatore del blog di cui si è coautore
                                    $result4 = mysqli_query( $conn,$sql4) or die("Errore database:". mysqli_error($conn));
                                        $row4 = $result4->fetch_assoc();
                                        $nome_utente=$row4['nome'];



                                    $sql2="SELECT sfondo FROM grafica WHERE id_grafica='$id_grafica'"; //la foto del blog di cui si è coautore
                                    $result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                                    if($result1->num_rows > 0) {
                                        $row1 = $result1->fetch_assoc();
                                        $img=$row1['sfondo'];
                                    }

                                       echo (" <article id='blog'>

                                       <button> <a href = 'modifica_blog.php?id=$id_blog'><img id='ope1'src='modifica.png'> </img></a></button>
                                       <button>  <a href='elimina_blog.php?id=$id_blog'><img id='ope1'src='elimina.png'> </img></a></button><a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>
                                       <img src='sfondi/$img' id='sfondo'> </img>

                                        </article>");

                                    $i++;
                            }

                    }
                    else //l'utente non è coautore di nessun blog
                    {
                        echo(" <article class='post'>
                           <a id='logo' > -- NON CI SONO ANCORA BLOG DA COAUTORE!-- </a> </article>");
                    }

                    mysqli_free_result($result);

                ?>


            </section>


            <div class="elenco3">

                        <button class='btn' id='btn-blog'> MY_BLOG</button>


                        <button class='btn' id='btn-coautore-blog'>BLOG_COAUTORE</button>

            </div>

    </body>
</html>
