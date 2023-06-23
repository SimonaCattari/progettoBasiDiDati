<?php
include('connessione.php');
//eliminazione del coautore
$id_coautore = $_GET['id_c'];


        $sql = "DELETE FROM coautore WHERE id_user='$id_coautore'";

      $cancella=mysqli_query($conn, $sql);

      if($cancella){
        ?>

        <script type="text/javascript">
          alert('Coautore eliminato con successo');
          window.location.replace('profilo_blog.php');
        </script>

        <?php
}
  else{
    echo "Eliminazione fallita";
    }
?>
