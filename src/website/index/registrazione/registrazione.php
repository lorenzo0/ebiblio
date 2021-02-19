<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Registration</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap and CSS-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
      
  </head>
    <header></header>
    <body>
        <?php

            require '../../../connectionDB/connection.php';
        
            if(isset($_POST['submit'])){

                $nomeUtente = $_POST['nome'];
                $cognomeUtente = $_POST['cognome'];
                $emailUtente = $_POST['email'];
                $passwordUtente = $_POST['passwordUtente'];
                $passwordUtente = md5($passwordUtente);
                $dataNascitaUtente = $_POST['dataNascita'];
                $tipoUtente = $_POST['tipoUtente'];
                $luogoNascitaUtente = $_POST['luogoNascita'];
                $recapitoUtente = $_POST['recapito'];
                $professione = $_POST['professione'];



                try {
                    $sql = "INSERT INTO Utente VALUES('$emailUtente', '$nomeUtente', '$cognomeUtente', '$passwordUtente', '$dataNascitaUtente', '$luogoNascitaUtente', '$recapitoUtente', '$tipoUtente')";
                    $res=$pdo->query($sql);
                }catch(PDOException $e) {
                    echo("Query SQL Failed: ".$e->getMessage());
                    exit();
                }

                if($res != 0){
                        $currentData = date("Y/m/d");
                        try {
                            $sql = "INSERT INTO Utilizzatore VALUES('$emailUtente', '$professione', 'Attivo', '$currentData')";
                            $res=$pdo->query($sql);
                        }catch(PDOException $e) {
                            echo("Query SQL Failed: ".$e->getMessage());
                            exit();
                        }
                    }


                if($res != 0)
                    echo "<script> alert('Richiesta processata correttamente!'); window.location.href='../login/loginPage.html'; </script>";
                else
                    echo "<script> alert('La richiesta NON è stata processata correttamente!'); window.location.href='registrationPage.php'; </script>";
            }

        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Registrati con il tuo account</h4>
                    <div class="imgcontainer">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                <form method="post" onsubmit="return validateFormRegistrazione();">
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo nome" class="form-control" name="nome" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo cognome" class="form-control" name="cognome" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="email" placeholder="Inserisci la tua email" class="form-control" name="email" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="password" placeholder="Inserisci la tua password" class="form-control" name="passwordUtente" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="date" placeholder="Inserisci la tua data di nascita" class="form-control" name="dataNascita" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo luogo di nascita" class="form-control" name="luogoNascita" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo numero di telefono" class="form-control" name="recapito" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci la tua professione" class="form-control" name="professione" id="professione">
                    </div> 
                    
                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Crea account  </button>
                    </div>     
                <p class="text-center">Hai già un account? <a href="../login/loginPage.html">Accedi!</a> </p>      

                </form>
                </article>
            </div>

        </div>
        <div id="footer"></div>
    </body>
</html>