<?php

require_once('connessione.php');
session_start();

//file per la visualizzazione di un utente all'interno del blog


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

                <input type='button' value='Registrati' onclick="location.href='form_registrazione.php'">

                </div>

            </div>

            <section class="blog" id='profilo_blog'>

                <div class ="profilo">
                    <div class ="imgprofilo">
                        <?php

                            $id = $_GET['id'];



                            $sql0="SELECT immagine, nome FROM utente_log WHERE id_utente = '$id'";
                            $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn));
                            $row0 = $result0->fetch_array();
                            $img = $row0['immagine'];
                            $nomeu= $row0['nome'];

                            echo "$nomeu";
                            echo "<img src='avatar/$img' id='profilo' > </img>";



                        ?>

                    </div>
                </div>

                <?php
                $id = $_GET['id'];
                $sql="SELECT nome, id_user, id_blog, id_grafica FROM blog WHERE id_user = '$id' ";
                $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                if ($result->num_rows > 0)
                {
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

                                    if($row1['sfondo'] != null){

                                        echo (" <article id='blog'>

                                        <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>
                                            <img src='sfondi/$img' id='sfondo'> </img>

                                            </article>");
                                    }else{
                                        echo (" <article id='blog'>

                                        <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>

                                            </article>");
                                    }

                                $i++;
                        }

                }
                else
                {
                    echo("");
                }

                mysqli_free_result($result);

            ?>
            </section>

            <section class="blog" id='coautore_blog'>

            <div class ="profilo">
                    <div class ="imgprofilo">
                        <?php

                            $id = $_GET['id'];



                            $sql0="SELECT immagine FROM utente_log WHERE id_utente = '$id'";
                            $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn));
                            $row0 = $result0->fetch_array();
                            $img = $row0['immagine'];


                            echo "<img src='avatar/$img' id='profilo' > </img>";



                        ?>

                    </div>
                </div>

                <?php
                    $id = $_GET['id'];


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

                                    $sql4="SELECT nome FROM utente_log WHERE id_utente='$id_creatore'";
                                    $result4 = mysqli_query( $conn,$sql4) or die("Errore database:". mysqli_error($conn));
                                        $row4 = $result4->fetch_assoc();
                                        $nome_utente=$row4['nome'];



                                    $sql2="SELECT sfondo FROM grafica WHERE id_grafica='$id_grafica'";
                                    $result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                                    if($result1->num_rows > 0) {
                                        $row1 = $result1->fetch_assoc();
                                        $img=$row1['sfondo'];
                                    }

                                    if($row1['sfondo'] != null){

                                        echo (" <article id='blog'>

                                        <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>
                                            <img src='sfondi/$img' id='sfondo'> </img>

                                            </article>");
                                    }else{
                                        echo (" <article id='blog'>

                                        <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp $nome</a><br>UTENTE: $nome_utente <br><br>

                                            </article>");
                                    }

                                    $i++;
                            }

                    }
                    else
                    {
                        echo("");
                    }

                    mysqli_free_result($result);

                ?>


            </section>


</section>


            <div class="elenco3">

                        <button class='btn' id='btn-blog'> MY_BLOG</button>

                        <button class='btn' id='btn-coautore-blog'>BLOG_COAUTORE</button>

            </div>

    </body>
</html>
