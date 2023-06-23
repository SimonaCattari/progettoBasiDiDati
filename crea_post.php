 <?php

require_once('connessione.php');
session_start();

//presentazione del form per la creazione di un post da parte di un utente registrato

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
                    <form action="creazione_post.php" method="POST" id="crea" enctype="multipart/form-data">
                    <div class="inputbox">

                        <input type="text" name="titolo_post" required="required" placeholder="Inserisci il titolo del post">

                    </div>

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

                        <textarea id="post-text" name="testo_post" placeholder="Scrivi il tuo post..."></textarea>

                    </div>

                    <div class="inputbox">

                        <input type="file" accept="image/*" id="file-input" name="file"   placeholder="Inserisci la tua immagine">

                    </div>

                    <div class="inputbox">

                    <input type="file" accept="image/*" id="file-input" name="file1"   placeholder="Inserisci la tua immagine">

                    </div>

                    <div class="inputbox">

                        <input type="submit"  value="Posta">

                    </div>

                    </form>


            </section>

            <div class="elenco">

            </div>
            <div class="elenco2">


            </div>
    </body>
</html>
