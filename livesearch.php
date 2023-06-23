<?php
include('connessione.php');

//file richiamato con ajax per la ricerca live in index.php



if(isset($_POST['input'])){ //se viene inserito qualcosa dall'utente
  $input = mysqli_real_escape_string($conn,$_POST['input']); //viene preso il valore e viene fatto il controllo per prevenire le SQL Injection


  // selezione dei blog in cui sono presenti le lettere inserite dall'utente
  $sql = "SELECT * FROM blog WHERE nome LIKE '%{$input}%'";
  $result = mysqli_query($conn, $sql); //mysqli_query è la funzione che esegue la query SQL --> come paramentri prende la connessione al DB e la query da eseguire

  if(mysqli_num_rows($result) > 0){ //mysqli_num_rows --> viene utilizzata per ottenere il numero di righe restituite da una query di selezione.
    ?>


          <h1>Risultati Blog : </h1>


        <?php
        while($row = mysqli_fetch_assoc($result)){ //Recupera una riga di dati dal set di risultati e la  restituisce i dati in un array associativo3. Ogni successiva chiamata a questa funzione restituirà la riga successiva all'interno del set di risultati
          $nome=$row['nome'];
          $id_blog=$row['id_blog'];
         ?>
         <ul>
           <!-- si mostrano i risultati (tramite elenco puntato) cliccabili della ricerca dei blog che rimandano al blog stesso-->
           <li><?php echo ("<a href='visualizza_blog.php?id_blog=$id_blog'> $nome </a>"); ?></li>
         </ul>
         <?php
         }
         ?>


     <?php
  }else{
    echo "<h8>Non esistono blog con questa chiave di ricerca.<br></h8>";
  }

  $sql1 = "SELECT id_tema FROM tema WHERE nome LIKE '%{$input}%'";
  $result1 = mysqli_query($conn, $sql1);


  if(mysqli_num_rows($result1) > 0){
    ?>


          <h1>Risultati Temi : </h1>


        <?php
        while($row1 = mysqli_fetch_assoc($result1)){
        $id_tema = $row1['id_tema'];
        $sql6 = "SELECT nome FROM tema WHERE id_tema ='$id_tema'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = $result6->fetch_assoc();

        $nome = $row6['nome'];
         ?>
         <ul>
           <li><?php echo ("<a href='visualizza_tema.php?id=$id_tema'> $nome </a>"); ?></li>
         </ul>


     <?php
  }}else{
    echo "<h8>Non esistono temi con questa chiave di ricerca.<br></h8>";
  }

    $sql1 = "SELECT * FROM post WHERE titolo LIKE '%{$input}%'";
  $result1 = mysqli_query($conn, $sql1);

  if(mysqli_num_rows($result1) > 0){
    ?>


          <h1>Risultati Post : </h1>


        <?php
        while($row1 = mysqli_fetch_assoc($result1)){
          $titolo1=$row1['titolo'];
          $id =$row1['id_post'];
         ?>
         <ul>
           <li><?php echo ("<a href='visualizza_post.php?id=$id'> $titolo1 </a>") ?></li>
         </ul>
         <?php
         }
         ?>


     <?php
  }else{
    echo "<h8>Non esistono post con questa chiave di ricerca.<br></h8>";
  }

  $sql2 = "SELECT * FROM utente_log WHERE nome LIKE '%{$input}%'";
  $result2 = mysqli_query($conn, $sql2);

  if(mysqli_num_rows($result2) > 0){
    ?>


          <h1>Risultati Utente : </h1>


        <?php
        while($row2 = mysqli_fetch_assoc($result2)){
          $nome3=$row2['nome'];
          $id = $row2['id_utente'];
         ?>
         <ul>
           <li><?php echo ("<a href='profilo_utente.php?id=$id'> $nome3 </a>") ?></li>
         </ul>
         <?php
         }
         ?>


     <?php
  }else{
    echo "<h8>Non esistono utenti con questa chiave di ricerca.<br></h8>";
  }



}
?>
