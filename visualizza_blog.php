<?php

require_once('connessione.php');
session_start();

//file per la visualizzazione del blog e quindi dei suoi post, in modo diverso e con privilegi diversi, da parte dell'utente e del visitatore

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
        <a id="logo" href="index.php" > Blog </a>
          <div id='coaut'>
                <?php

                    $id = $_GET['id_blog'];


                    $sql4="SELECT id_grafica, nome, id_user FROM blog  WHERE id_blog = '$id'";
                    $result4 = mysqli_query($conn, $sql4) or die("Errore database:". mysqli_error($conn));
                    $row4 = $result4->fetch_array();
                    $id_grafica = $row4['id_grafica'];
                    $nome_blog = $row4['nome'];
                    $id1 = $row4['id_user'];

                    if(isset($_SESSION['id_user']))
                    {
                      $user_session=$_SESSION['id_user'];
                        if ($_SESSION['id_user'] == $id1)
                        {
                          $sql1="SELECT nome, id_utente FROM utente_log WHERE id_utente = ( SELECT id_user FROM coautore WHERE id_blog = '$id')";
                          $result1 = mysqli_query( $conn,$sql1) or die("Errore database:". mysqli_error($conn));
                          $row1 = $result1->fetch_assoc();

                            if ($result1->num_rows == 0)
                            {
                              echo "<button> <a href = 'modifica_coautore.php?id=$id'> IMPOSTA COAUTORE </a></button>";
                            }
                            else{
                              $coautore = $row1['nome'];
                              $id_c = $row1['id_utente'];

                              echo "<a> COAUTORE : $coautore </a>
                              <button> <a href = 'modifica_coautore.php?id=$id'><img id='ope1'src='modifica.png'> </img></a></button>
                              <button>  <a href='elimina_coautore.php?id_c=$id_c'><img id='ope1'src='elimina.png'> </img></a></button>";
                            }
                          }
                      }

                ?>
           </div>


            </div>

            <section class="blog">
            <?php

                    $sql6="SELECT id_user FROM coautore  WHERE id_blog = '$id'";
                    $result6 = mysqli_query($conn, $sql6) or die("Errore database:". mysqli_error($conn));
                    $row6 = $result6->fetch_array();
                    $id_coautore = $row6['id_user'];


                    $sql5="SELECT sfondo, colore_font, font FROM grafica  WHERE id_grafica = '$id_grafica'";
                    $result5 = mysqli_query($conn, $sql5) or die("Errore database:". mysqli_error($conn));
                    $row5 = $result5->fetch_array();
                    $img = $row5['sfondo'];
                    $colore = $row5['colore_font'];
                    $font = $row5['font'];
                    if(isset($_SESSION['id_user']))
                    {
                        $user_session=$_SESSION['id_user'];





                     if(isset($user_session) && $id_coautore == $user_session || $id1 == $user_session)
                            {
                                echo ("<div class ='profilo2'>
                                <button> <a href = 'modifica_blog.php?id=$id'><img id='ope1'src='modifica.png'> </img></a></button>
                                <button>  <a href='elimina_blog.php?id=$id'><img id='ope1'src='elimina.png'> </img></a></button>

                                <a id='titolo' ><font face='$font' color='$colore'> $nome_blog</font></a>
                                            <div class ='imgprofilo'>
                                            <img src='sfondi/$img' id='profilo'>
                                            </div>

                                       </div>");

                            $sql="SELECT titolo FROM post WHERE id_blog = '$id'";
                            $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                            echo ("<div class='inputbox'>

                                        <a href='crea_post.php'><input type='button' value='crea post'> </a>

                                    </div>");
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
                                          else
                                          {
                                              echo(" <article class='post'>
                                                 <a id='logo' > -- NON CI SONO ANCORA POST NEL BLOG!-- </a> </article>");
                                          }
                                      }
                                      elseif(isset($user_session))
                                      {
                                          echo ("<div class ='profilo2'>

                                          <a id='titolo' ><font face='$font' color='$colore'> $nome_blog</font></a>
                                                      <div class ='imgprofilo'>
                                                      <img src='sfondi/$img' id='profilo'>
                                                      </div>

                                                 </div>");

                                              $sql="SELECT titolo FROM post WHERE id_blog = '$id'";
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
                                            else
                                            {
                                                echo(" <article class='post'>
                                                   <a id='logo' > -- NON CI SONO ANCORA POST NEL BLOG!-- </a> </article>");
                                            }
                                        }}
                                    else
                                    {
                                        echo ("<div class ='profilo2'>

                                        <a id='titolo' ><font face='$font' color='$colore'> $nome_blog</font></a>
                                                    <div class ='imgprofilo'>
                                                    <img src='sfondi/$img' id='profilo'>
                                                    </div>

                                               </div>");

                                        $sql="SELECT titolo FROM post WHERE id_blog = '$id'";
                                        $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
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
                                                        $imgg1 = $row3['immagine'];
                                                        $imgg2 = $row3['immagine1'];
                                                        $data1 = $row3['data'];

                                                        if($row3['immagine'] != null)
                                                        {

                                                            if($row3['immagine1'] != null)
                                                            {

                                                                echo ("
                                                                <article class='post'>
                                                                <a id='logo' > $titolo <br> $testo_post <br> </a>
                                                                <img id='img-post' src='img_post/$imgg2'>
                                                                <img id='img-post'src='img_post/$imgg1'> <br> <a> Data Pubblicazione: $data1<a></img>
                                                                <div id='commenti'>

                                                            ");
                                                            }
                                                            else
                                                            {

                                                                echo ("
                                                                        <article class='post'>
                                                                            <a id='logo' > $titolo <br> $testo_post <br> </a>
                                                                            <img id='img-post'src='img_post/$imgg1'> <br> <a> Data Pubblicazione: $data1<a></img>
                                                                            <div id='commenti'>

                                                                        ");
                                                            }



                                                        }
                                                        else
                                                        {
                                                            echo ("
                                                            <article class='post'>
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

                                                                        echo "
                                                                        <article id='c'>
                                                                        <a id='c1'> $nome: &nbsp&nbsp $testo &nbsp&nbsp $data &nbsp&nbsp $ora &nbsp&nbsp<br><br></a>
                                                                        </article>";

                                                                }
                                                        }
                                                        else {
                                                            echo'ANCORA NESSUN COMMENTO!';
                                                        }
                                    echo("</div> </article>");
                            }
                }
                else
                    {
                        echo(" <article class='post'>
                           <a id='logo' > -- NON CI SONO ANCORA POST NEL BLOG!-- </a> </article>");
                    }
            }

                ?>

            </section>

    </body>
</html>
