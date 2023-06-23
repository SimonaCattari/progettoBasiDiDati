<?php
  session_start();
  require_once('connessione.php');
  //visualizzazione del form di registrazione. L'immagine non è settabile da qui per problemi di scambio dati tra ajax e php
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
      <meta name="viewport" content="width=device-width">
      <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
      <link rel="stylesheet" href="stile1.css">

      <title>Registrazione</title>

    </head>

    <body>
      <section class="center" id="center1">
        <div class="form" method="POST">
          <form autocomplete="off" id="myForm">
            <a id="logo1" > Blog </a>

            <div class="form-message"></div>

            <div class="inputbox">
              <p>Nome</p>
              <input type="text" name="nome" required="required" placeholder="Inserisci il tuo nome">
            </div>

            <div class="inputbox">
              <p>E-mail</p>
              <input type="email"  name="email" required="required" placeholder="Inserisci e-mail">
            </div>

            <div class="inputbox">
              <p>Password</p>
              <input type="password"  name="password" required="required" placeholder="Inserisci la tua password">
            </div>

            <div class="inputbox">
              <p>Telefono</p>
              <input type="tel"  name="telefono" required="required" placeholder="Inserisci il tuo numero">
            </div>

            <div class="inputbox">
              <p>Documento</p>
              <input type="text"  name="documento" required="required" placeholder="Inserisci numero documento">
            </div>

            <div class="inputbox">
              <input type="submit" id="btn-submit" value="Registrati">
            </div>

            <div class="line"></div>

            <a class="p" id="a1"> Hai già un account?<a class="request" href='form_accesso.php' > Accedi</a></a>

          </form>
        </div>
      </section>

      <script type="text/javascript">
      $(document).ready(function(){ //Una funzione da eseguire quando viene attivato l'evento
        $("#myForm").on('submit',function(e){ //la funzione si attiva quando viene cliccato il tasto submit (REGISTRATI)
          e.preventDefault(); //impedisce al pulsante di inviare il modulo
          $.ajax({ //per inviare il modulo uso ajax
            type: "POST", //metodo post per l'invio dei dati
            url: "registrazione.php", //dopo aver cliccato il pulsante di invio l'url si sposta su registrazione.php
            data:new FormData(this), //un oggetto {chiave : valore} che contiene i dati da inviare al server
            dataType: "json", //il tipo di dati che ci aspettiamo dal server
            contentType: false, //non imposta nessuna intestazione al tipo di contenuto
            cache: false, //ricarica ogni volta i dati del server anche se non sono cambiati
            processData: false, //i dati inviati al server non saranno pre-processati ma inviati direttamente
            success: function(response){ //funzione da lanciare se la richiesta ha successo. Accetta come argomenti i dati restituiti dal server
              $(".form-message").css("display", "block"); //non si vede
              if(response.status == 1){ //se il form viene inviato correttamente
                $("#myForm")[0].reset(); //viene resettato
                $(".form-message").html('<p>' + response.message + '</p>'); //mostrato il messaggio di successo
              }else{ //ci sono errori nell'inserimento dei dati
                $(".form-message").html('<p>' + response.message + '</p>'); //messaggio di insuccesso
              }
            }
          });
        });
      });
    </script>
  </body>
</html>
