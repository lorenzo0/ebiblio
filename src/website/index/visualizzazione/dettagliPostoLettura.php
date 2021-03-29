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
        
            $id = $_GET['Id'];
            $data = $_GET['Data'];
            $oraInizio = $_GET['OraInizio'];
        
            try{
                        
                    $sql = "SELECT B.Nome, PL.Ethernet, PL.Corrente, PPL.OraFine
                            FROM PrenotazionePostoLettura AS PPL
                            JOIN PostoLettura AS PL ON(PPL.IdPostoLettura = PL.Id)
                            JOIN Biblioteca AS B ON(PL.NomeBiblioteca = B.Nome)
                            WHERE PPL.IdPostoLettura = '$id' 
                            AND EmailUtilizzatore = '" . $_SESSION['EmailUtente'] . "'
                            AND DataPrenotazione = '$data' AND OraInizio = '$oraInizio'";
                    $res = $pdo -> query($sql);
 
            }catch(PDOException $e){echo $e->getMessage();}	
        
            while ($row = $res->fetch()) {
                $nomeBiblioteca = $row['Nome'];
                $ethernet = $row['Ethernet'];
                $corrente = $row['Corrente'];
                $oraFine = $row['OraFine'];
            }  
        ?>
         <div class="topnav">
            <a href="../home/myHome.php" >Home</a>
            <a href="../prenotazioni/prenotazionePostoLettura/controllaDisponibilitaPostoLettura.php">Prenota posto lettura</a>
            <a href="../prenotazioni/prenotazioneLibroCartaceo/controllaDisponibilitaCartaceo.php">Prenota Libro</a>
            <a href="conversazioni.php">Conversazioni</a>
             <a href="prenotazioniEffettuate.php" class="active">Prenotazioni</a>
            <a href="visualizzazioneSegnalazioni.php" >Segnalazioni</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 800px;">
                    
                    <button class="backHomePage"> <a style="color:#fff;" href="../profilo/profilo.php"> Torna al profilo </a></button>

                    <h4 class="card-title mt-3 text-center">Dettagli Prenotazione Posto Lettura - <?php echo $id; ?></h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/desk.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Id:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="nome" id="nome" value = "<?php echo $id ?>"readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Data prenotazione:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="cognome" id="cognome" value = "<?php echo $data ?>"readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Ora Inizio:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="dataNascita" value = "<?php echo $oraInizio ?>" readonly>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Ora Fine:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $oraFine ?>" readonly>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Biblioteca Ospitante:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $nomeBiblioteca ?>" readonly>
                            </div>
                    </div>
                    
                        
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Ethernet:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php if($ethernet) echo 'disponibile'; else echo 'non disponibile' ?>" readonly>
                            </div>
                    </div>

                    <!--se può accedere anche da qua l'utente bisogna gestire l'incremento del numero accessi-->
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Corrente:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php if($corrente) echo 'disponibile'; else echo 'non disponibile' ?>" readonly>
                            </div>
                    </div>
                    
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