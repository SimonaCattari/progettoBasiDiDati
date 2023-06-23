<?php
session_start();

require_once('connessione.php');

//passaggio variabili dal form
$nome = mysqli_real_escape_string($conn,$_POST['nome_blog']);
$sottotema = mysqli_real_escape_string($conn,$_POST['sottotema']);
$font = $_POST['font'];
$colore = $_POST['colore'];
$coautore = $_POST['nome_coautore'];
$tema = $_POST['tema'];
$id = $_SESSION['id_user'];

$file = $_FILES['file'];

$filename =  $_FILES['file']['name'];
$filetmpname =  $_FILES['file']['tmp_name'];
$filesize =  $_FILES['file']['size'];
$fileerror =  $_FILES['file']['error'];
$filetype =  $_FILES['file']['type'];

$est_file = explode('.', $filename); //suddivide una stringa in un array
$est_attuale_file = strtolower(end($est_file)); //strtolower = converte i caratteri in minuscolo / end = restituisce il valore dell'ultiimo elemento dell'array

$estensioni = array('jpg', 'jpeg', 'png', 'gif');

if(in_array($est_attuale_file, $estensioni))
{
    if ($fileerror === 0)
    {
        if($filesize < 10000000)
        {
                $filename1 = uniqid('', true).".".$est_attuale_file;
                $path = "sfondi";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $destinazione = 'sfondi/'.$filename;
                move_uploaded_file($filetmpname, $destinazione);
                header("Location: profilo_blog.php");


        }
        else
        {

            echo"";
        }
    }
    else
    {
        echo"";
    }
}
else
{
    echo"";
}

// selezione della grafica
$sql="SELECT id_grafica FROM grafica WHERE font='$font' AND colore_font='$colore' AND sfondo='$filename'";
$result = mysqli_query($conn ,$sql) or die("Errore database:". mysqli_error($conn));


if($result->num_rows == 0) //Se non esiste
{
    // richiesta di inserimento della grafica
    $sql1="INSERT INTO grafica(font, sfondo, colore_font) VALUES ('$font', '$filename', '$colore')";

    if($conn->query($sql1)===true)
    {
        $sql2="SELECT id_grafica FROM grafica WHERE font='$font' AND colore_font='$colore' AND sfondo='$filename'";
        $result2 = mysqli_query( $conn,$sql2) or die("Errore database:". mysqli_error($conn));
        $row1 = $result2->fetch_assoc();
        $id_grafica = implode($row1); //implode = restituisce una stringa dagli elementi di un array
        echo("");
    }
}
else //se la grafica esiste già ne preleva i valori
{
    $row = $result->fetch_assoc();
    if(isset($row)){
            $id_grafica = implode($row);
            echo"";

    }
}

//selezionde del tema
$sql3="SELECT id_tema FROM tema WHERE nome = '$tema'";
$result3 = mysqli_query( $conn,$sql3) or die("Errore database:". mysqli_error($conn));

if($result3->num_rows > 0)
{
    $row2 = $result3->fetch_assoc();
    $id_tema = implode($row2);
    echo"";
}

// richiesta di inserimento del nuovo blog nel db
$sql5="INSERT INTO blog(nome, id_grafica, id_tema, id_user) VALUES ('$nome', '$id_grafica', '$id_tema', '$id')";

if($conn->query($sql5)===true)
{

    $sql6="SELECT id_blog FROM blog WHERE nome='$nome'";
    $result5 = mysqli_query( $conn,$sql6) or die("Errore database:". mysqli_error($conn));
    $row3 = $result5->fetch_assoc();
    $id_blog = implode($row3);




    if(isset($coautore)) //se il coautore è settato si estrae
    {
        $sql9= "SELECT id_utente FROM utente_log WHERE nome = '$coautore'";
        $resulto = mysqli_query( $conn,$sql9) or die("Errore database:". mysqli_error($conn));
        $row4 = $resulto->fetch_assoc();

        if(isset($row4))
        {
            $id_coautore = implode($row4);
            $sql7="INSERT INTO coautore(id_blog, id_user) VALUES ('$id_blog', '$id_coautore')"; //si inserisce il coautore
        if($conn->query($sql7)===true)
        {
            echo"";
        }
        }



    }
    else
    {
        echo"";
    }

    if(isset($sottotema)) //se il sottotema è settato 
    {
        $sql8="INSERT INTO sottotema ( id_tema, id_blog, nome) VALUES ( '$id_tema', '$id_blog', '$sottotema')"; //si inserisce nel db


        if($conn->query($sql8)===true)
        {
            echo"";
        }
        else{
            echo"";
        }
    }
}

header('Location: profilo_blog.php');

?>
