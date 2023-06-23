<!DOCTYPE html>
<html> 
<!-- Visualizzazione del form per l'accesso di un utente  -->
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                    <title>Accedi</title>

                <meta name="viewport" content="width=device-width">
                <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
            <link rel="stylesheet" href="stile1.css">

    </head>

    <body>
        <a id="scritta">Blog</a>
        <div class="center">
            <form action="accesso.php" method="POST">
              <div class="inputbox">

                <p>Nome</p>
                <input type="text" name="nome" required="required" placeholder="Inserisci il tuo nome">
                
              </div>

              <div class="inputbox">
                
                <p>Password</p>
                <input type="password" name="password" required="required" placeholder="Inserisci la tua password">
                 
              </div>

              <div class="inputbox">
                <input type="submit" value="Accedi">
              </div>

              <div class="line"></div>

              
              <a class="request"> Non sei ancora registrato?</a></a>

              <button class="log" onclick="location.href='form_registrazione.php'">
                Registrati
              </button>

            </form>
          </div>
    </body>
</html>