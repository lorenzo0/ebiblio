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
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
   </script>
      
  </head>
    
    <?php
    
    require '../../../../connectionDB/connection.php';
    /*if ($_SESSION['TipoUtente']!="Amministratore"){
        echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>"; 
    }*/
    
        if(isset($_POST['messaggioButton'])){
            $emailAmministratore = $_SESSION['EmailUtente'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $titolo = $_POST['titolo'];
            $messaggio = $_POST['messaggio'];
            $nota = $_POST['note'];
            $data = date("Y-m-d");
            
            $sql = $pdo->prepare("INSERT INTO Messaggio (EmailAmministratore, EmailUtilizzatore, DataMessaggio, Titolo, Testo) VALUES (?, ?, ?, ?, ?)");
            $sql->bindParam(1, $emailAmministratore, PDO::PARAM_STR);
            $sql->bindParam(2, $emailUtilizzatore, PDO::PARAM_STR);
            $sql->bindParam(3, $data, PDO::PARAM_STR);
            $sql->bindParam(4, $titolo, PDO::PARAM_STR);
            $sql->bindParam(5, $messaggio, PDO::PARAM_STR);
            $res = $sql->execute();
            
            if($res > 0)
               echo "<script> alert('Messaggio inserito correttamente!'); window.location.href='../../home/home.php'; </script>";
            else
                echo "<script> alert('Il messaggio non è stato inserito correttamente, riprova!'); window.location.href='inserimentoMessaggio.php'; </script>";
        }
        
    ?>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../../home/home.php">Home</a>
            <a href="../inserimentoAmministratore/inserimentoAmministratore.html">Inserisci utente</a>
            <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
            <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php" >Inserisci biblioteca</a>
            <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="inserimentoMessaggio.php" class="active">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Invia un messaggio ad un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/bottle.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <div class="form-group input-group">
                            <input type=”text” class="form-control" name="titolo" id="titolo" placeholder='Inserisci il titolo del tuo messaggio' required> 
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
                            <textarea class="form-control" name="messaggio" id="messaggio" placeholder="Inserisci qui il tuo messaggio" rows="4" cols="50" required></textarea>
                       </div> 
                       
                       <div class="form-group input-group">
                            <input type=”text” class="form-control" name="note" id="note" placeholder='Inserisci una nota'> 
                       </div> 
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="messaggioButton"> Invia il messaggio! </button>
                        </div>
                    </form>
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
</html>