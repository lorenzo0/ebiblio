<!DOCTYPE html>

<?php
    require '../../../../connectionDB/connection.php';
    require '../../../../connectionDB/connectionMongo.php';
    if($_SESSION['TipoUtente']=="Utilizzatore"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
     }else if($_SESSION['TipoUtente']=="SuperUser"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
     }else if($_SESSION['TipoUtente']==""){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
     }else if ($_SESSION['TipoUtente']=="Amministratore"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
    }
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
   <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../../utils/footer.html"); 
        });
        
        $(document).ready(function(){  
              var i=1;  
              $('#aggiungi').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="idPrenotazione[]" id="idPrenotazione[]" class="form-control"><?php try{ $sql = "SELECT Distinct(Email), Nome, Cognome FROM PrenotazioneCartaceo join utente on(EmailUtilizzatore = Email) WHERE IdPrenotazioneCartaceo NOT IN (SELECT IdPrenotazioneCartaceo FROM Consegna)"; $res = $pdo -> query($sql); }catch(PDOException $e){echo $e->getMessage();} while ($row = $res->fetch()) {  echo '<option value=' . $row['Email'] . '>'. $row['Nome'] . ' ' . $row['Cognome'] . '</option>';}?></select></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });  
         }); 
        
        
   </script>
  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../../home/volHome.php" >Home</a>
            <a href="consegna.php"class="active">Consegne</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../../profilo/profilo.php'">Account</button>
            
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Consegna</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/delivery.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                    <label> Scegli utente a cui consegnare: </label>
                       <div class="form-group">  
                           <table class="table table-bordered" id="dynamic_field" style="margin-top:0px;">  
                                <tr>  
                                     <td>
                                         <select name="idPrenotazione[]" id="idPrenotazione[]" class="form-control">
                                            <?php    
                                                try {
                                                    $cont = 0;
                                                    $sql = "SELECT Distinct(Email), Nome, Cognome 
                                                            FROM PrenotazioneCartaceo 
                                                            JOIN utente on(EmailUtilizzatore = Email)
                                                            WHERE IdPrenotazioneCartaceo NOT IN (SELECT IdPrenotazioneCartaceo 
                                                                                                 FROM Consegna)"; 
                                                    $res=$pdo->query($sql);

                                                } catch(PDOException $e) {echo("Query SQL Failed: ".$e->getMessage()); }

                                                 while($row = $res->fetch()) {
                                                    $cont++;
                                                    echo '<option value=' . $row['Email'] . '>'. $row['Nome'] . ' ' . $row['Cognome'] . '</option>'; 
                                                 }

                                            ?> 
                                        </select>
                                    </td>  
                                     <td><button type="button" name="aggiungi" id="aggiungi" class="btn btn-success">Aggiungi</button></td>  
                                </tr>  
                           </table> 
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
                        <input type="text" placeholder="note" class="form-control" name="note" id="note">
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
                         $emailVolontario = $_SESSION['EmailUtente'];
                        
                        for($i=0; $i<count($idPrenotazione); $i++){
                            for($y=$i+1; $y<(count($idPrenotazione)-$i); $y++){
                                if($idPrenotazione[$i] == $idPrenotazione[$y])
                                    unset($idPrenotazione[$y]);
                            }
                          }
                        
                        $sql_emailUtilizzatore = "Select MAX(IdConsegna) AS MaxConsegna FROM Consegna";
                        $res = $pdo->query($sql_emailUtilizzatore);
                        
                        while($row = $res->fetch()) {
                            if($row['MaxConsegna'] != 0)
                                $id = ($row['MaxConsegna'] + 1);
                            else
                                $id = 0;
                        }
                       
                        $sqlConsegna = $pdo->prepare("INSERT INTO Consegna VALUES(?, ?, ?, ?, ?, ?, ?)");
                        for($i=0; $i<count($idPrenotazione); $i++){
                            
                            $sql = "Select * 
                                    FROM PrenotazioneCartaceo join cartaceo on(CodiceISBNCartaceo = CodiceISBN)
                                    WHERE EmailUtilizzatore = '$idPrenotazione[$i]' and statoprestito = 'Prenotato'";
                            $res = $pdo->query($sql);
                            
                            
                            while($row = $res->fetch()) {
                                
                                $sqlConsegna->bindParam(1, $id, PDO::PARAM_INT);
                                $sqlConsegna->bindParam(2, $row['IdPrenotazioneCartaceo'], PDO::PARAM_INT);
                                $sqlConsegna->bindParam(3, $emailVolontario, PDO::PARAM_STR);
                                $sqlConsegna->bindParam(4, $idPrenotazione[$i], PDO::PARAM_STR);
                                $sqlConsegna->bindParam(5, $note, PDO::PARAM_STR);
                                $sqlConsegna->bindParam(6, $tipologiaConsegna, PDO::PARAM_STR);
                                $sqlConsegna->bindParam(7, $data, PDO::PARAM_STR);
                                
                                $res1 = $sqlConsegna->execute();
                            }
                            
                        }
                        
                        if ($res>0) {
                            $bulk = new MongoDB\Driver\BulkWrite();

                            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Consegna', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
                            $bulk -> insert($doc);
                            $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                        
                           echo "<script> alert('Consegna inserita correttamente!'); window.location.href='../../home/volHome.php'; </script>";
                        }else 
                           echo "<script> alert('La consegna NON è stata inserita correttamente!'); window.location.href='consegna.php'; </script>";
                         
                    }
                ?> 
            

        </div>
         
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
          <div class="container p-2"> EBIBLIO</div>
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright: Progetto Basi di Dati 2020/21
          </div>
        </footer>  
</html>


