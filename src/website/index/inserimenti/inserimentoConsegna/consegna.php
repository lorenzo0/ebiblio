<!DOCTYPE html>

<?php
        require '../../../../connectionDB/connection.php';      
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Login</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
   <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
   </script>
  </head>
    <header></header>
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Consegna</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/phone-call.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                    <div class="form-group">
                       <label for="utilizzatore">Scegli Consegna da effettuare:</label> 
                          <select class="form-control" id="idPrenotazione" name="idPrenotazione">
                                  <?php    
                                        try {
                                            $cont = 0;
                                            $sql = "SELECT IdPrenotazioneCartaceo 
                                                    FROM PrenotazioneCartaceo 
                                                    WHERE IdPrenotazioneCartaceo NOT IN (SELECT IdPrenotazioneCartaceo 
                                                                                         FROM Consegna)"; 
                                            $res=$pdo->query($sql);
    
                                        } catch(PDOException $e) {echo("Query SQL Failed: ".$e->getMessage()); }
                                            
                                         while($row = $res->fetch()) {
                                            $cont++;
                                            echo "<option value=" . $row['IdPrenotazioneCartaceo'] . ">". $row['IdPrenotazioneCartaceo'] . "</option>";        
                                         }
                                        
                                    ?> 
                          </select>
                        </div>
                       
                    <div class="form-group">
                        <?php 
                            if($cont==0) 
                                echo '<label style="color:red;">Tutte le prenotazioni sono state già consegnate!</label>';
                            else
                                echo '<a href="../visualizzazione/visualizzazionePrenotazioni.php"> Vedi i dettagli di tutte le prenotazioni </a>'
                        ?>
                    </div>
                       

                    <div class="form-group">
                    <label for="tipologiaConsegna">Tipologia di Consegna:</label>
                      <select class="form-control" id="tipologiaConsegna" name="tipologiaConsegna">
                        <option value= "Affidamento">Affidamento</option>
                        <option value= "Restituzione">Restituzione</option>
                      </select>
                    </div>
                       
                      <div class="form-group input-group">
                        <input type="text" placeholder="note" class="form-control" name="note" id="note" required>
                    </div> 

                    
                    <div class="form-group input-group">
                        <input type="date" placeholder="data consegna" class="form-control" name="data" id="data" required>
                    </div> 
                       
                    


                <div class="form-group">
                        <button type="submit" name="consegna" id="consegna" class="btn btn-primary btn-block"> Inserisci Consegna </button>
                    </div>      
               </form>
                </article>
            </div>
            
               <?php           
                    if(isset($_POST['consegna'])){
                    
                         $idPrenotazione = $_POST['idPrenotazione'];
                         $data = $_POST['data'];
                         $note= $_POST['note'];
                         $tipologiaConsegna = $_POST['tipologiaConsegna']; 
                         $emailVolontario = $_SESSION['email-accesso'];
                         $id = 0;
                       
                        $sql_emailUtilizzatore = "Select * FROM PrenotazioneCartaceo WHERE IdPrenotazioneCartaceo = $idPrenotazione";
                        $res= $pdo->query($sql_emailUtilizzatore);
                        
            
                        while($row = $res->fetch()) {
                            $emailUtilizzatore = $row['EmailUtilizzatore'];
                        }
            
                        $sql = $pdo->prepare("INSERT INTO Consegna VALUES(?, ?, ?, ?, ?, ?, ?)");
                        
                        $sql->bindParam(1, $id, PDO::PARAM_INT);
                        $sql->bindParam(2, $idPrenotazione, PDO::PARAM_STR);
                        $sql->bindParam(3, $emailVolontario, PDO::PARAM_STR);
                        $sql->bindParam(4, $emailUtilizzatore, PDO::PARAM_STR);
                        $sql->bindParam(5, $note, PDO::PARAM_STR);
                        $sql->bindParam(6, $tipologiaConsegna, PDO::PARAM_STR);
                        $sql->bindParam(7, $data, PDO::PARAM_STR);
                        
                        $res = $sql->execute();
                        
                        if ($res>0) {
                           echo "<script> alert('Consegna inserita correttamente!'); window.location.href='../home/home.php'; </script>";
                         } else {
                           echo "<script> alert('La consegna NON è stata inserita correttamente!'); window.location.href='consegna.php'; </script>";
                         }
                    }
                ?> 
            

        </div>
        <div id="footer"></div>
    </body>
</html>


