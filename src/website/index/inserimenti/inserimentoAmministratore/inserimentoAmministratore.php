<?php
    require '../../../../connectionDB/connection.php';
    require '../../../../connectionDB/connectionMongo.php';

     if ($_SESSION['TipoUtente']=="Amministratore"){
        echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
    }else if($_SESSION['TipoUtente']=="Utilizzatore"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
     }else if($_SESSION['TipoUtente']=="Volontario"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
     }else if($_SESSION['TipoUtente']==""){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
     }

    if(isset($_POST['submit'])){
        $nomeUtente= $_POST['nomeUtente'];
        $cognomeUtente = $_POST['cognomeUtente'];
        $emailUtente = $_POST['emailUtente'];
        $password = $_POST['password'];
        $password = md5($password);
        $dataNascita= $_POST['dataNascita'];
        $luogoNascita = $_POST['luogoNascita'];
        $recapito = $_POST['recapito'];
        $nomeEncode = $_POST['biblio'];
        $qualifica = $_POST['qualifica'];

        $amministratore = "Amministratore";

        $sql = $pdo->prepare("INSERT INTO Utente VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

        $sql->bindParam(1, $emailUtente, PDO::PARAM_STR);
        $sql->bindParam(2, $nomeUtente, PDO::PARAM_STR);
        $sql->bindParam(3, $cognomeUtente, PDO::PARAM_STR);
        $sql->bindParam(4, $password, PDO::PARAM_STR);
        $sql->bindParam(5, $dataNascita, PDO::PARAM_STR);
        $sql->bindParam(6, $luogoNascita, PDO::PARAM_STR);
        $sql->bindParam(7, $recapito, PDO::PARAM_STR);
        $sql->bindParam(8, $amministratore, PDO::PARAM_STR);

        $res = $sql->execute();

        if ($res >0 ) {
            try{
                $nomeBiblio = urldecode($nomeEncode);
                echo $emailUtente;
                echo $decode;
                echo $qualifica;
                 $sql = $pdo->prepare("INSERT INTO Amministratore VALUES (?, ?, ?)");    
                
                 $sql->bindParam(1, $emailUtente, PDO::PARAM_STR);
                 $sql->bindParam(2, $nomeBiblio, PDO::PARAM_STR);
                 $sql->bindParam(3, $qualifica, PDO::PARAM_STR);
                 
                 $res = $sql->execute();
            } catch(PDOException $e) {
                echo($e->getMesssage());	
                exit();	
            } 

            if($res>0){
                $bulk = new MongoDB\Driver\BulkWrite();
                $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Amministratore', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
                $bulk -> insert($doc);
                $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                echo "<script> alert('Amministratore inserito correttamente'); window.location.href='../../home/superUserHome.php'; </script>";
            }else
                echo "<script> alert('L'amministratore NON è stato inserito correttamente'); window.location.href='inserimentoAmministratore.php'; </script>";
        }
    }

?>



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
    <body>
        <div class="topnav">
            <a href="../../home/adminHome.php" >Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci Biblioteca</a>
                    <a href="inserimentoAmministratore.php"  class="active">Inserisci Amministratore</a>
                </div>
            </div>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Amministratore</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/users.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                    
                       <div class="form-group input-group">
                          <input type="text" placeholder="nome" class="form-control" name="nomeUtente" id="nomeUtente" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="cognome" class="form-control" name="cognomeUtente" id="cognomeUtente" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="email" class="form-control" name="emailUtente" id="emailUtente" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="password" placeholder="password (6 caratteri minimo)" class="form-control" name="password" id="password" minlength="6" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="date" placeholder="data nascita" class="form-control" name="dataNascita" id="dataNascita" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="luogo nascita" class="form-control" name="luogoNascita" id="luogoNascita" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="number" placeholder="Recapito" class="form-control" name="recapito" id="recapito" required>
                       </div> 
                       
                       <label> Nome della biblioteca amministrata: </label>
                        <div class="form-group input-group">
                            <select name="biblio" id="biblio" class="form-control">
                                <?php

                                    try{
                                        $sql = "SELECT Nome FROM Biblioteca";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . urlencode($row['Nome']) . '>' . $row['Nome'] . '</option>';
                                    }

                                ?>
                            </select>
                       </div> 
                       
                       <div class="form-group input-group">
                          <input type="text" placeholder="Qualifica" class="form-control" name="qualifica" id="qualifica" required>
                       </div> 

                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Crea Utente </button>
                    </div>           
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