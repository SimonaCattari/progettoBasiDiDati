<?php
session_start();

//file per la registrazione dell'utente

require_once('connessione.php');

//dato che viene restituiti nell'Ajax per visualizzare i messaggi ri errore / successo --> è un array associativo che contiene 2 chiavi (lo stato e i messaggi)
$response = array(
  'status' => 0,
  'message' => ''
);

//prelevo i dati del form
$nome=$_POST['nome'];
$email=$_POST['email'];
$password=$_POST['password'];
$telefono=$_POST['telefono'];
$documento=$_POST['documento'];

//se sono tutti settati
if(isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['password'])  || isset($_POST['telefono']) || isset($_POST['documento']) ){

  //se non è vuoto
  if(!empty($_POST['nome'])){
    $ome = mysqli_real_escape_string($conn,$_POST['nome']); //controllo per le Query Injection
    $sql = "SELECT nome from utente_log where nome ='".$nome."'"; //richiesta di estrazione dato dal db
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    $n='';

    if($count > 0){
      $response['status'] = false;
      $response['message'] = 'Username già in uso!';
      $n=false;
    }elseif(strlen($nome) < 5 || strlen($nome) > 15){
      $response['status'] = false;
      $response['message'] = 'Username deve avere minimo 5 caratteri e massimo 15!';
      $n=false;
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $nome)){
      $response['status'] = false;
      $response['message'] = 'Lo username deve essere composto solo da caratteri alfanumerici.';
      $n=false;
    }
    else{
      $n=true;
    }
  }

  if(!empty($_POST['email'])){
    $mail = mysqli_real_escape_string($conn, $_POST['email']);
    $sql1 = "SELECT email from utente_log where email ='".$email."'";
    $res1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($res1);

    $e='';

    if($count1 > 0){
      $response['status'] = false;
      $response['message'] = 'Email già in uso!';
      $e=false;
    }elseif(!preg_match("/^[A-z0-9\.\_-]+@[a-z0-9\.]+\.[a-z]{2,6}+$/", $email)){
	$response['status'] = false;
	$response['message'] = "Inserire una mail valida, ad esempio nome.cognome@gmail.com!";
	$e=false;
    }else{
      $e=true;
    }
  }

  if(!empty($_POST['password'])){
    $assword = mysqli_real_escape_string($conn,$_POST['password']);
    $sql2 = "SELECT password from utente_log where password ='".$password."'";
    $res2 = mysqli_query($conn, $sql2);


    $p='';

    if(strlen($password) < 6 || strlen($password) > 10){
      $response['status'] = false;
      $response['message'] = 'La password deve avere dai 6 ai 10 caratteri!';
      $p=false;
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $password)){
      $response['status'] = false;
      $response['message'] = 'La password non può contenere caratteri speciali.';
      $p=false;
    }
    else{
      $p=true;
    }
  }

  if(!empty($_POST['telefono'])){
  $tel = mysqli_real_escape_string($conn, $_POST['telefono']);
  $sql3 = "SELECT telefono from utente_log where telefono ='".$telefono."'";
  $res3 = mysqli_query($conn, $sql3);
  $count3 = mysqli_num_rows($res3);

  $t='';

  if($count3 > 0){
    $response['status'] = false;
    $response['message'] = 'Numero di telefono già in uso!';
    $t=false;
  }elseif(!preg_match("/^0\d{9}|^3\d{9}$/", $telefono)){
    $response['status'] = false;
    $response['message'] = 'Inserire un numero di cellulare o un numero fisso';
    $t=false;
  }
  else{
    $t=true;
  }
}

  if(!empty($_POST['documento'])){
  $doc = mysqli_real_escape_string($conn, $_POST['documento']);
  $sql4 = "SELECT documento from utente_log where documento ='".$documento."'";
  $res4 = mysqli_query($conn, $sql4);
  $count4 = mysqli_num_rows($res4);

  $d='';

  if($count4 > 0){
    $response['status'] = false;
    $response['message'] = 'Questo documento è già in uso!';
    $d=false;
  }elseif(!preg_match("/^[A-Z]+\d{5}[A-Z]{2}$/", $documento)){
    $response['status'] = false;
    $response['message'] = 'Inserire un numero della carta di identità valido che abbia il formato XX00000XX';
    $d=false;
  }
  else{
    $d=true;
  }
  }

if($n == true && $e == true && $p == true && $t == true && $d == true){

    $sqll="INSERT INTO utente_log(nome,email,password,telefono,documento) VALUES ('$nome', '$email', '$password', '$telefono', '$documento')";

    if($conn->query($sqll)===true)
    {
      $response['status'] = true;
      $response['message'] = 'Registrazione effettuata con successo! Effettuare il Login!';
    }else{
      $response['status'] = false;
      $response['message'] = 'Errore';
    }
  }

}

echo json_encode($response); //codifica in formato json

?>
