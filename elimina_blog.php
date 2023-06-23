<?php
include('connessione.php');

//eliminazione del blog

$id = $_GET['id'];


        $sql = "DELETE FROM blog WHERE id_blog='$id'";

        $cancella=mysqli_query($conn, $sql);

      if($cancella){
        ?>

        <script type="text/javascript">
          alert('blog eliminato con successo');
          window.location.replace('profilo_blog.php');
        </script>

        <?php
}
  else{
    echo "Eliminazione fallita";
    }
?>
