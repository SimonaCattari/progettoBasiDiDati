<?php

require_once('connessione.php');
session_start();

//pagina principale del blog.
//la pagina viene visualizzata, in modo differente e con diversi privilegi, dall'utente e dal visitatore

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

      <!-- div che mostra i risultati della ricerca dinamica -->
    <div class="elenco" id='searchresult'>

</div>

<div class="elenco2">

</div>

    <div class="menu">
                <?php

                // se l'utente ha effettuato il login
                if(isset($_SESSION['id_user']))
                {

                    $id = $_SESSION['id_user'];


                    // si estrae dal db l'immagine
                    $sql0="SELECT immagine FROM utente_log WHERE id_utente = '$id'";
                    $result0 = mysqli_query($conn, $sql0) or die("Errore database:". mysqli_error($conn)); //esegue la query nel database verificando la connessione
                    $row0 = $result0->fetch_array(); //restituisce i dati in un array associativo / numerico
                    $img = $row0['immagine']; //si accede al valore tramite chiave (nome del campo nel db)

                    // se l'immagine esiste viene mostrata cliccabile che rimanda al profilo personale dellìutente
                  if($row0['immagine'] != null)
                  {
                    echo ("
                                <a href='profilo_blog.php?id=$id'><img  id='profilo1' src='avatar/$img' > </img></a>


                                <div class='cerca'>
                                    <input type='text' id='live_search' placeholder='Cerca'>
                                </div>
                                <div class='inputbox'>

                    <a id='btn-new-blog' href='crea_blog.php'>&nbsp&nbsp&nbsp&nbsp&nbspCrea Blog</a>

                </div>");
                  }
                  // se l'immagine non esiste viene viasuzzato un link "MY PROFILE" che riporta al profilo personale dell'utente
                  else
                  {
                    echo ("
                               <a href='profilo_blog.php?id=$id'> MY_PROFILE </a>


                                <div class='cerca'>
                                    <input type='text' id='live_search' placeholder='Cerca'>
                                </div>
                                <div class='inputbox'>

                    <a id='btn-new-blog' href='crea_blog.php'>&nbsp&nbsp&nbsp&nbsp&nbspCrea Blog</a>

                </div>");
                  }
                  }

                // se l'utente non è registrato / non ha fatto il login --> appare solo la barra di ricerca
                else
                {
                    echo ("<a id='logo'> Blog </a>
                            <div class='cerca'>
                                <input type='text' id='live_search'  placeholder='Digita qualcosa per avviare la ricerca'>
                            </div>
                            <div class='inputbox'>

                    <a id='btn-accedi' href='form_registrazione.php'>&nbsp&nbsp&nbsp&nbsp&nbspREGISTRATI</a>

                </div>");
                            // salvataggio nel db l'IP del visitatore
                            // $_SERVER = array che contiene informazioni sul server
                            function vero_id() {
                                if (!empty($_SERVER['HTTP_CLIENT_IP'])) //controllo che HTTP_CLIENT_IP contiene qualcosa, se non è vuota assegno il valore a $id
                                {
                                    $id = $_SERVER['HTTP_CLIENT_IP']; //HTTP_CLIENT_IP = per conoscere l'IP quando l'utente accede alla pagina
                                }
                                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //altrimenti, se HTTP_X_FORWARDED_FOR non è vuota, assegno il valore a $id
                                {
                                  $id = $_SERVER['HTTP_X_FORWARDED_FOR']; //HTTP_X_FORWARDED_FOR = Serve a rilevare l'ip del client anche quando è mascherato da un proxy
                                }
                                else                              //altrimenti assegno a $id l'indirizzo reale dell'utente
                                {
                                  $id = $_SERVER['REMOTE_ADDR'];  //REMOTE_ADDR = indirizzo IP reale dell'utente, è l'unica informazione veramente affidabile, in quanto ti viene trasmessa dal tuo server web che sta gestendo la richiesta.
                                }
                                return $id; //restituisco l'id
                              }
                              $id = vero_id();

                        $sql1="INSERT INTO visitatore(IP) VALUES ('$id')"; //inserisco l'IP nel db

                }
                ?>

            </div>

            <section class="blog" id='index'>

              <!-- VISUALIZZAZIONE DEI BLOG ESISTENTI -->
            <?php

                // Estrazione dei blog
                $sql="SELECT * FROM blog ";
                $result = mysqli_query( $conn,$sql) or die("Errore database:". mysqli_error($conn));
                if ($result->num_rows > 0) //Ottiene il numero di righe nel set di risultati - se è > 0 (restituisce risultati)
                {
                        $i = 0;
                        while($i != 9 && $row = $result->fetch_assoc()) //il numero di righe viene restutuito con un array associativo
                        {
                                //si estraggono in risultati con le chiavi che sono i nomi dei campi del db
                                $nome=$row["nome"];
                                $id_utente=$row["id_user"];
                                $id_blog=$row["id_blog"];
                                $id_grafica=$row["id_grafica"];
                                $id_tema =$row['id_tema'];

                                // Estrazione dei nomi dei temi dei singoli blog
                                $sql5="SELECT nome FROM tema WHERE id_tema='$id_tema'";
                                $result5 = mysqli_query( $conn,$sql5) or die("Errore database:". mysqli_error($conn));
                                    $row5 = $result5->fetch_assoc();
                                    $nome_tema=$row5['nome'];

                                // Estrazione dei nomi degli utenti proprietari dei blog
                                $sql4="SELECT nome FROM utente_log WHERE id_utente='$id_utente'";
                                $result4 = mysqli_query( $conn,$sql4) or die("Errore database:". mysqli_error($conn));
                                    $row4 = $result4->fetch_assoc();
                                    $nome_utente=$row4['nome'];


                                // Estrazione dello sfondo delle grafiche dei blog
                                $sql2="SELECT sfondo FROM grafica WHERE id_grafica='$id_grafica'";
                                $result1 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
                                if($result1->num_rows > 0) {
                                    $row1 = $result1->fetch_assoc();
                                    $img=$row1['sfondo'];
                                }

                                // se l'utente è proprietario dei blog che appaiono nella home --> vede le icone per modificare o eliminare il proprio blog
                                if($id_utente == $id)
                                {
                                   echo (" <article id='blog'>

                                   <button> <a href = 'modifica_blog.php?id=$id_blog'><img id='ope1'src='modifica.png'> </img></a></button>
                                    <button onclick='elimina($id_blog)'><img src='elimina.png' id='ope'></img></button><a href='visualizza_blog.php?id_blog=$id_blog' id='logo'> &nbsp $nome</a><br>UTENTE:<a href='profilo_utente.php?id=$id_utente'> $nome_utente <br><br>
                                    ");

                                    if($row1['sfondo'] != null){ //se esiste la foto viene mostrata
                                        echo "<img src='sfondi/$img' id='sfondo'> </img>

                                        </article>";
                                    }
                                    else{ //altrimenti no
                                        echo "</article>";
                                    }
                                }
                                else //se non è proprietario di nessun blog che appare nella home può cliccare nei blog
                                {

                                   echo" <article id='blog'>
                                            <a href='visualizza_blog.php?id_blog=$id_blog id='logo'> &nbsp  $nome </a><br>UTENTE:<a href='profilo_utente.php?id=$id_utente'> $nome_utente <br><br> TEMA: <a href='visualizza_tema.php?id=$id_tema'> $nome_tema<br></a>
                                            ";

                                            if($row1['sfondo'] != null){
                                                echo "<img src='sfondi/$img' id='sfondo'> </img>

                                                </article>";
                                            }
                                            else{
                                                echo "</article>";
                                            }

                                }
                                // incremento dell'indice del ciclo while
                                $i++;
                        }

                }
                //se la query non restituisce niente
                else
                {
                    echo("<article class='post'>
                    <a id='logo' > -- NON CI SONO ANCORA POST NEL BLOG!-- </a> </article>");
                }

                // Recupera le righe da un set di risultati, quindi libera la memoria associata al risultato
                mysqli_free_result($result);

            ?>

            </section>

            <script>
              $(document).ready(function(){ //Il metodo ready() viene utilizzato per rendere disponibile una funzione dopo il caricamento del documento
                $("#live_search").keyup(function(){ //viene avviata la funzione quando viene attivato l'evento
                  var input = $(this).val(); // accede al valore con JQuerry
                  if(input != ""){ //se input viene settato si attiva Ajax
                    $.ajax({
                      url : "livesearch.php", //url della pagine di riferimento
                      method : "POST",  //metodo dell'invio dei dati
                      data : {input,input}, //vengono salvati i dati da mandare

                      success : function(data){ //se la chiamata Ajax ha avuto successo si avvia la funzione che prende come parametro i dati
                        $("#searchresult").html(data); //assegna all'id dei risultati i dati
                        $("#searchresult").css("display", "block"); //li mostra
                      }
                    });
                  //se non è settato l'input
                  }else{
                    $("#searchresult").css("display", "none"); //non viene visualizzato l'id del risultato della ricerca

                  }
                });
              });

            </script>


    </body>
</html>
