
<?php session_start(); // apertura sessione
 include 'connessione.php'; //inclusione file per la connessione

  $nome = $_POST['nome']; //passaggio variabile dal form
  $password = $_POST['password']; //passaggio variabile dal form

  $nome = mysqli_real_escape_string($conn, $nome); //controllo dati
  $password = mysqli_real_escape_string($conn, $password); //controllo dati


  //prendo e controllo i dati dal db con i miei dati

  $sql="SELECT * FROM utente_log WHERE nome = '". $nome . "'  AND password = '". $password. "'";


  $result = mysqli_query($conn, $sql); //mysqli_query è la funzione che esegue la query SQL --> come paramentri prende la connessione al DB e la query da eseguire


    $corretto = mysqli_fetch_array($result); //Restituisce una matrice che corrisponde alla riga recuperata e sposta in avanti il ​​puntatore ai dati interni.


    if($corretto > 0)
    {
      $_SESSION['id_user']=$corretto['id_utente'];
      $id_utente=$_SESSION['id_user'];

      header('Location: profilo_blog.php?id_utente=$id_utente');
    }
    else
    {//stampo l'errore tramite l'alert
    ?>

        <script type="text/javascript">
        alert('Credenziali inserite non valide');
        window.location.replace('form_accesso.php');

      </script>
      <?php
    }
//}
?>
