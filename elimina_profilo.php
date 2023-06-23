<?php
include('connessione.php');
//eliminazione profilo utente
$id = $_GET['id'];


        $sql = "DELETE FROM utente_log WHERE id_utente='$id'";

        $cancella=mysqli_query($conn, $sql);

      if($cancella){
        session_destroy();
        ?>

        <script type="text/javascript">
          alert('Profilo eliminato com successo');
          window.location.replace('form_registrazione.php');
        </script>

        <?php
}
  else{
    echo "Eliminazione fallita";
    }
?>