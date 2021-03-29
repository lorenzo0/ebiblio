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
                $luogoNascitaUtente = $_POST['luogoNascita'];
                $recapitoUtente = $_POST['recapito'];
                $professione = $_POST['professione'];
                $tipoUtente = 'Utilizzatore';



                try {                    
                    $sql = $pdo->prepare("INSERT INTO Utente VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $sql->bindParam(1, $emailUtente, PDO::PARAM_STR);
                    $sql->bindParam(2, $nomeUtente, PDO::PARAM_STR);
                    $sql->bindParam(3, $cognomeUtente, PDO::PARAM_STR);
                    $sql->bindParam(4, $passwordUtente, PDO::PARAM_STR);
                    $sql->bindParam(5, $dataNascitaUtente, PDO::PARAM_STR);
                    $sql->bindParam(6, $luogoNascitaUtente, PDO::PARAM_STR);
                    $sql->bindParam(7, $recapitoUtente, PDO::PARAM_INT);
                    $sql->bindParam(8, $tipoUtente, PDO::PARAM_STR);
                    $res = $sql->execute();
                    
                }catch(PDOException $e) {
                    echo("Query SQL Failed: ".$e->getMessage());
                    exit();
                }

                if($res > 0){
                        $currentData = date("Y/m/d");
                        $statoAccount = 'Attivo';
                        try {
                            $sql = $pdo->prepare("INSERT INTO Utilizzatore VALUES (?, ?, ?, ?)");
                            $sql->bindParam(1, $emailUtente, PDO::PARAM_STR);
                            $sql->bindParam(2, $professione, PDO::PARAM_STR);
                            $sql->bindParam(3, $statoAccount, PDO::PARAM_STR);
                            $sql->bindParam(4, $currentData, PDO::PARAM_STR);
                            $res = $sql->execute();
                        }catch(PDOException $e) {
                            echo("Query SQL Failed: ".$e->getMessage());
                            exit();
                        }
                    
                    if($res > 0){
                        $bulk = new MongoDB\Driver\BulkWrite();
                        $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Utilizzatore', 'tipoUtente'=>$tipoUtente, 'emailUtente'=>$emailUtente, 'timeStamp'=>date('Y-m-d H:i:s')];
                        $bulk -> insert($doc);
                        $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                        echo "<script> alert('Richiesta processata correttamente!'); window.location.href='../login/login.php'; </script>";
                    }else
                        echo "<script> alert('La richiesta NON è stata processata correttamente!'); window.location.href='registrationPage.php'; </script>";
                    }
            }

        ?>
         <div class="topnav">
            <a href="../home/home.php">Home</a>
            <a href="../../openStreetMap/map.html">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
            </div>
        </div>
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
                        <input type="password" placeholder="Inserisci la tua password (6 caratteri minimo)" class="form-control" name="passwordUtente" minlength="6"  required>
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
                <p class="text-center">Hai già un account? <a href="../login/login.php">Accedi!</a> </p>      

                </form>
                </article>
            </div>

        </div>
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>