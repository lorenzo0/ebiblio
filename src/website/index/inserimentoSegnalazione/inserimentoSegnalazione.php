<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Segnalazione</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
      
  </head>
    
    <?php
    
    require '../../../connectionDB/connection.php';
    
        if(isset($_POST['segnalazione'])){
            $emailAmministratore = $_POST['emailAmministratore'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $nota = $_POST['note'];
            $data = date("Y/m/d");
            
            $sql = "INSERT INTO Segnalazione VALUES(0, '$emailAmministratore', '$emailUtilizzatore', '$data', '$nota')";
            $res = $pdo -> exec($sql);
            
            if($res=0)
                echo "<script type='text/javascript'>alert('Non è stata la segnalazione, riprova!');</script>";
            else
                echo "<script type='text/javascript'>alert('Segnalazione inserita correttamente!');</script>";
        }
        
    ?>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-verde">
          <a class="navbar-brand" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
              <a class="nav-link metalink" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>

          </div>
        </nav>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Segnala un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../images/warning.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       <!-- Da rimuovere quando inseriamo la variabile di sessione -->
                       <?php $_SESSION['email-accesso']="amm@email.it"; ?>
                       
                       <div class="form-group input-group">
                            <!-- variabile di sessione email loggato -->
                            <input type="text" class="form-control" name="emailAmministratore" id="emailAmministratore" value="<?php echo $_SESSION['email-accesso'];?>"/>
                       </div> 
                       
                       <div class="form-group input-group">
                            <select name="emailUtilizzatore" id="emailUtilizzatore" class="form-control">
                                <?php

                                    try{
                                        $sql = "SELECT Email, Nome, Cognome FROM Utente WHERE tipoUtente = 'Utilizzatore'";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Email'] . '>' . $row['Nome'] . ' ' . $row['Cognome'] . '</option>';
                                    }

                                ?>
                            </select>

                       </div> 
                       
                       <div class="form-group input-group">
                            <textarea class="form-control" name="note" id="note" placeholder="Inserisci qui una nota" rows="4" cols="50"></textarea>
                       </div> 
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="segnalazione"> Invia Segnalazione! </button>
                        </div>
                    </form>
                </article>
            </div>
             

        </div>
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Base di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>