<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Posto Lettura</title>
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
                    <h4 class="card-title mt-3 text-center">Prenotazione Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                    
                   <div>
                       <form method="post"> 

                         <div class="form-group">
                           <label for="utilizzatore">Scegli un orario di prenotazione:</label> 
                              <select class="form-control" id="postoLettura" name="postoLettura">
                                      <?php    
                                            require '../../../connectionDB/connection.php';
                                    
                                            try {

                                                $ethernet = $_POST['ethernet'];
                                                $corrente = $_POST['power'];
                                                $data = $_POST['data'];
                                                $i=0;
                                                
                                                $sql = "SELECT Id, HOUR(OraInizio) As OraInizio, MINUTE(OraInizio) AS MinutiInizio, HOUR(OraFine) AS OraFine, MINUTE(OraFine) AS MinutiFine
                                                        FROM PostoLettura AS PL
                                                        JOIN PrenotazionePostoLettura AS PPL 
                                                        WHERE Ethernet = " .$ethernet . "
                                                        AND Corrente = " .$corrente . "
                                                        AND DataPrenotazione = '" .$data . "'";

                                                $res=$pdo->query($sql);

                                                    } catch(PDOException $e) {
                                                        echo("Query SQL Failed: ".$e->getMessage());
                                                        exit();
                                                    }
                                                 while($row = $res->fetch()) {
                                                    echo "<option value=" . $row['Id'] . ">". $row['EmailBiblioteca'] ." Presa Ethernet: ". $row['Ethernet'] ." Presa Corrente: ". $row['Corrente']. "</option>";                                 
                                                 }
                                                 
                                        ?> 

                              </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name='prenota' id='prenota' class="btn btn-primary btn-block"> Prenota! </button>
                            </div>        
                       </form>
                   </div>
                </article>
            </div>
            
            <?php

                if(isset($_POST['prenota'])){
                    $emailUtilizzatore = $_POST['emailUtilizzatore'];
                    $oraInizio = $_POST['oraInizio'];
                    $oraFine = $_POST['oraFine'];
                    $dataPrenotazione = $_POST['dataPrenotazione'];
                    $postoLettura = $_POST['postoLettura'];

                    //gestione dinamica id posto lettra
                    $sql = "INSERT INTO PrenotazionePostoLettura (IdPostoLettura, EmailUtilizzatore, OraInizio, OraFine, DataPrenotazione) VALUES ($postoLettura,'$emailUtilizzatore','$oraInizio','$oraFine','$dataPrenotazione')"; 

                    $res = $pdo->exec($sql); 
                }
            ?>
            

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