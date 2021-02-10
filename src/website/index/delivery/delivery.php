<!DOCTYPE html>

<?php
        session_start();

        $dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
        $user = 'root';
        $password = 'root';

        try {
          $pdo = new PDO($dsn, $user, $password);  

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Login</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
  </head>
    
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
                    <h4 class="card-title mt-3 text-center">Inserisci Consegna</h4>
                    <div class="imgcontainer">
                        <img src="../../images/delivery.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="delivery.php" method="post"> 
                    
                    <div class="form-group">
                        <label for="tipologiaConsegna">Tipologia di Consegna:</label>
                          <select class="form-control" id="tipologiaConsegna" name="tipologiaConsegna">
                            <option value= "Affidamento">Affidamento</option>
                            <option value= "Restituzione">Restituzione</option>
                          </select>
                        </div>
                    
                    <div class="form-group input-group">
                        <input type="date" placeholder="data consegna" class="form-control" name="data" id="data" required>
                    </div> 
                      
                    <div class="form-group input-group">
                    <input type="text" placeholder="note" class="form-control" name="note" id="note" required>
                    </div> 
                       
                       
                    <div class="form-group input-group">
                    <input type="text" placeholder="email volontario" class="form-control" name="emailVolontario" id="emailVolontario" required>
                    </div> 
                       
                       
          
                     <div class="form-group">
                       <label for="utilizzatore">Scegli Utilizzatore:</label> 
                          <select class="form-control" id="emailUtilizzatore" name="emailUtilizzatore">
                              <!-- seleziona l'email utilizzatore dal db --> 
                                  <?php    
                                        try {
                                        $sql = "SELECT Email, Nome, Cognome FROM Utente WHERE TipoUtente = 'Utilizzatore'"; 
                                        $res=$pdo->query($sql);
    
                                            } catch(PDOException $e) {
                                                echo("Query SQL Failed: ".$e->getMessage());
                                                exit();
                                            }

                                             while($row = $res->fetch()) {
                                                echo "<option value=" . $row['Email'] . ">". $row['Nome'] ." ". $row['Cognome'] . "</option>";                                 
                                             }
                                    ?> 
                          </select>
                        </div>
                      
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Inserisci Consegna </button>
                    </div>          
               </form>
                    
        
                  <?php             
                    
                         $note = $_POST['note'];
                         $data = $_POST['data'];
                         $tipologiaConsegna = $_POST['tipologiaConsegna']; 
                         $emailUtilizzatore = $_POST['emailUtilizzatore'];
                         $emailVolontario = $_POST['emailVolontario'];
                    
                        //GESTIONE ID PRENOTAZIONE CARTACEO
                        $sql_id = "Select IdPrenotazione From EffettuaPrenotazione, PrenotazioneCartaceo WHERE PrenotazioneCartaceo.IdPrenotazioneCartaceo = EffettuaPrenotazione.IdPrenotazione";
                        
                        $res= $pdo->query($sql_id);
                        
                        while($row = $res->fetch()) {
                            
                            $var = $row ['idPrenotazione'];
                        }
                    
                        //al posto di 1 ci va $var
                        $sql = "INSERT INTO Consegna(IdConsegna, IdPrenotazioneCartaceo, EmailVolontario,  EmailUtilizzatore, Note, Tipo, DataConsegna) VALUES (0, 1, '$emailVolontario', '$emailUtilizzatore', '$note', '$tipologiaConsegna', '$data')";
                        
                        echo $note; 
                        echo $data; 
                        echo $tipologiaConsegna; 
                        echo $emailUtilizzatore; 
                        echo $emailVolontario; 
                    
                        $res = $pdo->exec($sql);
                        
                       /* if($res>0) {
                            echo "great"; 
                        } else {
                            echo "not great";
                        }*/
                    
                    ?> 
                
                </article>
            </div> <!-- card.// -->

        </div>
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Basi di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>




