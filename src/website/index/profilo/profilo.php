<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Ebook</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
        
        <?php
            require '../../../connectionDB/connection.php';
        
            try{
                $tipoUtente= $_SESSION['TipoUtente'];
                $email = $_SESSION['EmailUtente'];
            
                //echo "Tipo utente " . $tipoUtente . ".<br>";
                //echo "Email utente " . $email . ".<br>";
                
                
                $sql = "SELECT * FROM Utente WHERE Email = '$email'";
                $res = $pdo -> query($sql);
            }catch(PDOException $e){echo $e->getMessage();}	

                while ($row = $res->fetch()) {
                    $nome = $row['Nome'];
                    $cognome = $row['Cognome'];
                    $dataNascita = $row['DataNascita'];
                    $luogoNascita = $row['LuogoNascita'];
                    $recapitoTelefonico = $row['RecapitoTelefonico'];
                }        
        ?>
        <div class="topnav">
            <a herf="profilo.php" class="active">Account</a>
            <a href="../home/myHome.php">Home</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">

                    <h4 class="card-title mt-3 text-center">Your profile</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/users.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Nome:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="nome" id="nome" value = "<?php echo $nome ?>"readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Cognome:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="cognome" id="cognome" value = "<?php echo $cognome ?>"readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Data di nascita:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="dataNascita" value = "<?php echo $dataNascita ?>" readonly>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Luogo di nascita:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $luogoNascita ?>" readonly>
                            </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Recapito telefonico:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="RecapitoTelefonico" value = "<?php echo $recapitoTelefonico ?>" readonly>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-primary" href="modifica-recapito.php">Modifica</a>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                            <a class="btn btn-primary" href="prenotazioniEffettuate.php">Visualizza le tue prenotazioni effettuate</a>
                    </div>
                    
                    <div class="form-group row">
                            <a class="btn btn-primary" href="conversazioni.php">Visualizza i messaggi ricevuti </a>
                    </div>
                    
                    <div class="form-group row">
                            <a class="btn btn-primary" href="visualizzazioneSegnalazioni.php">Visualizza le segnalazioni ricevute</a>
                    </div>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>