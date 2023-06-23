<?php

//logout dell'utente

include("connessione.php");

session_start();

if(isset($_POST['esegui'])) {



session_destroy();

header('Location: form_accesso.php');

}

?>