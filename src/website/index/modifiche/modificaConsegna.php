<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
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

    <style>
        label{ margin-right: 15px; }
    </style>
      
  </head>
    <header></header>
    <body>
        
        <?php 
        
            require '../../../connectionDB/connection.php';
        
            if(isset($_POST['inserisci'])){
                
                try{
                    $sql = "UPDATE Consegna 
                            SET IdPrenotazioneCartaceo=".$_POST['IdP'].",
                            EmailVolontario='".$_POST['EmailV']."',
                            Note='".$_POST['Note']."',
                            Tipo='".$_POST['Tipo']."',
                            Dataconsegna='".$_POST['Data']."'
                            WHERE IdConsegna=".$_GET['IdConsegna'];
                    $res = $pdo->query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	
                
                if($res->rowCount() > 0)
                    echo "<script> alert('Valore aggiornato correttamente!'); window.location.href='../home/home.php'; </script>";
                else
                    echo "<script> alert('Qualcosa è andato storto..'); window.location.href='trovaConsegna.php'; </script>";
                
                
            }
        ?>
        
        
        
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Aggiorna i dati di consegna</h4>
                    <div class="imgcontainer">
                        <img src="../../images/delivery.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       <div class="form-group input-group">
                            <label> Id Consegna: </label>
                            <input type="text" class="form-control" name="idC" id="idC" value="<?php echo $_GET['IdConsegna']  ?>" readonly>
                       </div> 
                       
                       <div class="form-group input-group">
                            <label> Id Prenotazione: </label>
                            <input type="text" class="form-control" name="IdP" id="IdP" value="<?php echo $_GET['IdPrenotazione']  ?>">
                       </div> 
                       
                       <div class="form-group input-group">
                           <label> Email volontario: </label>
                            <select name="EmailV" id="EmailV" class="form-control">
                                <?php

                                    try{
                                        $sql = "SELECT Email, Nome, Cognome FROM Utente WHERE tipoUtente = 'Volontario'";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Email'] . '>' . $row['Nome'] . ' ' . $row['Cognome'] . '</option>';
                                    }

                                ?>
                            </select>

                       </div> 
                       
                       <div class="form-group input-group">
                            <label> Email utilizzatore: </label>
                            <input type="text" class="form-control" name="emailU" id="emailU" value="<?php echo $_GET['EmailU']  ?>" readonly>
                       </div>
                       
                       <div class="form-group input-group">
                            <label> Note: </label>
                            <input type="text" class="form-control" name="Note" id="Note" value="<?php echo $_GET['Note']  ?>">
                       </div>
                       
                       <div class="form-group input-group">
                        <label for="tipologiaConsegna">Tipologia di Consegna:</label>
                          <select class="form-control" id="Tipo" name="Tipo">
                            <option value= "Affidamento">Affidamento</option>
                            <option value= "Restituzione">Restituzione</option>
                          </select>
                        </div>
                       
                       <div class="form-group input-group">
                            <label> Data Consegna: </label>
                            <input type="date" class="form-control" name="Data" id="Data" value="<?php echo $_GET['Data']  ?>">
                       </div>
                       
                       <div class="form-group input-group">
                            <button type="submit" class="btn btn-primary btn-block" name="inserisci"> Aggiorna il tuo recapito! </button>
                       </div> 
                   </form>
               
                </article>
            </div>

        </div>
        <div id="footer"></div>
    </body>
</html>