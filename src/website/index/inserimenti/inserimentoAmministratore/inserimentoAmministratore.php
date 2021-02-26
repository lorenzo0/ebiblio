<?php
    require '../../../../connectionDB/connection.php';

     /*if ($_SESSION['TipoUtente']!="Amministratore"){
        echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
    }*/

    if(isset($_POST['submit'])){
        $nomeUtente= $_POST['nomeUtente'];
        $cognomeUtente = $_POST['cognomeUtente'];
        $emailUtente = $_POST['emailUtente'];
        $password = $_POST['password'];
        $password = md5($password);
        $dataNascita= $_POST['dataNascita'];
        $luogoNascita = $_POST['luogoNascita'];
        $recapito = $_POST['recapito'];
        $nomeBiblio = $_POST['biblio'];
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
                 $sql = $pdo->prepare("INSERT INTO Amministratore VALUES (?, ?, ?)");    
                
                 $sql->bindParam(1, $emailUtente, PDO::PARAM_STR);
                 $sql->bindParam(2, $nomeBiblio, PDO::PARAM_STR);
                 $sql->bindParam(3, $qualifica, PDO::PARAM_STR);
                
                 $res = $sql->execute();
            } catch(PDOException $e) {
                echo($e->getMesssage());	
                exit();	
            } 

            if($res>0)
                echo "<script> alert('Amministratore inserito correttamente'); window.location.href='../../login/login.php'; </script>";
            else
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
    <title>Ebiblio - Amministratore</title>
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
            <a href="../../home/home.php">Home</a>
            <a href="inserimentoAmministratore.html" class="active">Inserisci utente</a>
            <a href="../inserimentoAutore/inserimentoAmministratore.html">Inserisci autore</a>
            <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci biblioteca</a>
            <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
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
                                        echo '<option value=' . $row['Nome'] . '>' . $row['Nome'] . '</option>';
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
        <div id="footer"></div>
        
    </body>
</html>