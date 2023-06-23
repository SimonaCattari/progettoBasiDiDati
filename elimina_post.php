<?php
include('connessione.php');

//eliminazione del post

$id = $_GET['id'];




        $sql = "DELETE FROM post WHERE id_post='$id'";

        $cancella=mysqli_query($conn, $sql);

      if($cancella){
        ?>

        <script type="text/javascript">
          alert('post eliminato con successo');
          window.location.replace('profilo_blog.php');
        </script>

        <?php
}
  else{
    echo "Eliminazione fallita";
    }
?>
