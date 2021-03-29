<!DOCTYPE html>
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
   </script>
  </head>
    <header></header>
    
    <?php
    
        require '../../../../connectionDB/connection.php';
        require '../../../../connectionDB/connectionMongo.php';
        if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }else if ($_SESSION['TipoUtente']=="SuperUser"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
        }
        if(isset($_POST['segnalazione'])){
            $emailAmministratore = $_SESSION['EmailUtente'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $nota = $_POST['note'];
            $data = date("Y/m/d");
            $id = 0;
            
            $sql = $pdo->prepare("INSERT INTO Segnalazione (EmailAmministratore, EmailUtilizzatore, DataSegnalazione, Nota) VALUES (?, ?, ?, ?)");
            
            //$sql->bindParam(1, $id, PDO::PARAM_INT);
            $sql->bindParam(1, $emailAmministratore, PDO::PARAM_STR);
            $sql->bindParam(2, $emailUtilizzatore, PDO::PARAM_STR);
            $sql->bindParam(3, $data, PDO::PARAM_STR);
            $sql->bindParam(4, $nota, PDO::PARAM_STR);
            $res = $sql->execute();
            if($res > 0){
               $bulk = new MongoDB\Driver\BulkWrite();
                $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Segnalazione', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
                $bulk -> insert($doc);
                $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                
                echo "<script> alert('Segnalazione inserita correttamente!'); window.location.href='../../home/adminHome.php'; </script>";
            
            }else
                echo "<script> alert('La segnalazione non è stata inserita correttamente, riprova!'); window.location.href='inserimentoSegnalazione.php'; </script>";
        }
        
    ?>
    <body>
        <div class="topnav">
            <a href="../../home/adminHome.php">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php" >Inserisci Posto lettura</a>
                    <a href="../inserimentoLibro/inserimentoISBN.php">Inserisci libro</a>      
                </div>
            </div>
            <a href="../../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="inserimentoSegnalazione.php" class="active">Nuova segnalazione</a> 
            <a href="../../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggio</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Segnala un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/warning.png" alt="Avatar" width="50">
                    </div>
                   <form method="post"> 
                       
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
    </body>
    <footer class="text-center text-white fixed-bottom" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer
</html>